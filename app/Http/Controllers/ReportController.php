<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Models\FeeType;
use App\Models\User;
use App\Models\Fee;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\DocumentUpload;
use App\Models\DocumentName;
use App\Models\DocumentType;
use App\Models\FeeType;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use DataTables;
use Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
   public function generalDetailsReport(Request $request){
    // return $request;
    $session = $request->session;
    $course_name = $request->course_name;
    $reports =  User::where('role', 'Student')
        ->when($session, function ($q, $session) {
            return  $q->where('session', $session);
        })
        ->when($course_name, function ($q, $course_name) {
            return  $q->where('course_name', $course_name);
        })
    ->leftJoin('districts', 'districts.id', '=', 'users.district')
    ->get(['users.*', 'districts.name as district_name']);
    $view = view('backend.pages.report.general_details_report', compact('reports', 'session'))->render();
    // $view = view('backend.pages.holidayRecord.maternity_report', compact('reports'))->render();

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Nikosh');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($view);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return $dompdf->stream('general_details.pdf');
   }
   public function IndividualStudentReport($id){


$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'Nikosh');

$dompdf = new Dompdf($options);

// Blade টেমপ্লেট থেকে HTML রেন্ডার করুন
$view = view('backend.pages.report.individual_student_report')->render();

$dompdf->loadHtml($view);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

return $dompdf->stream('individual_student_student_details.pdf');





    // $student = User::where('users.id', $id)
    //     ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
    //     ->leftJoin('districts', 'districts.id', '=', 'users.district')
    //     ->leftJoin('upazilas', 'upazilas.id', '=', 'users.upazila')
    //     ->get(['users.*', 'divisions.name as division_name', 'upazilas.name as upazila_name', 'districts.name as district_name'])
    //     ->first();

    // return $view = view('backend.pages.report.individual_student_report', compact('student'))->render();

    // $options = new Options();
    // $options->set('isHtml5ParserEnabled', true);
    // $options->set('isRemoteEnabled', true);

    // $dompdf = new Dompdf($options);
    // $dompdf->loadHtml($view);
    // $dompdf->setPaper('A4', 'portrait');
    // $dompdf->render();

    // return $dompdf->stream('individual_student_student_details.pdf');
   }

   public function IndividualStudentPaymentReport($id){
    $student = User::where('users.id', $id)
    ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
    ->leftJoin('districts', 'districts.id', '=', 'users.district')
    ->leftJoin('upazilas', 'upazilas.id', '=', 'users.upazila')
    ->get(['users.*', 'divisions.name as division_name', 'upazilas.name as upazila_name', 'districts.name as district_name'])->first();
    $fees = Fee::where('fees.user_id', $id)
    ->leftJoin('fee_types', 'fee_types.id', '=', 'fees.fee_type_id')
    ->get(['fees.*','fee_types.name as fees_type_name']);
    $tuition = Fee::where('fees.user_id', $id)->where('fee_type_id',1)->sum('amount');
    $exam = Fee::where('fees.user_id', $id)->where('fee_type_id',2)->sum('amount');
    $registration = Fee::where('fees.user_id', $id)->where('fee_type_id',3)->sum('amount');
    $hostel = Fee::where('fees.user_id', $id)->where('fee_type_id',4)->sum('amount');
    $others = Fee::where('fees.user_id', $id)->where('fee_type_id',5)->sum('amount');
    // return $fees;
    $view = view('backend.pages.report.individual_student_payment_report', compact('student', 'fees','tuition', 'exam', 'registration', 'hostel', 'others'))->render();

    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($view);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return $dompdf->stream('individual_student_payment_report.pdf');
   }
   public function reportAllStudent(){
    return view('backend.pages.report.student_all');
   }
   public function allStudentTableReport(Request $request){
        if ($request->ajax()) {
            $data = User::where('role', 'Student')->orderBy('created_at', 'desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
                    ->editColumn('district', function($student){
                        $district = District::find($student->district);
                        return $district->name;
                    })
                    ->editColumn('session', function($student){
                        return $student->session.'-'.$student->session+1;
                    })
                    ->addColumn('type', function($student){
                        $documents = DB::table('document_uploads')
                        ->where('user_id', $student->id)->pluck('id');
                        return $documents;

                    })
                    ->addColumn('action', function($student){
                        $btn = '<a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="left" title="Individual student report"
                        href="'.route('individual.student.report',$student->id).'"><i class="fa-solid fa-print"></i></a>&nbsp;<a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="left" title="Individual payment report"
                        href="'.route('individual.student.payment.report',$student->id).'"><i class="fa-solid fa-file-invoice-dollar"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'full_name'])
                    ->make(true);
        }
    }
    public function monthWisePaymentReport(Request $request){
        // return $request;
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $reports = Fee::when(Auth::user()->role  == 'Account', function ($q) {
            $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $endOfCurrentMonth = Carbon::now()->endOfMonth()->toDateString();
        return $q->whereBetween('fees.created_at', [$startOfLastMonth, $endOfCurrentMonth])->where('uploader_id', Auth::user()->id);
    })
    ->when(Auth::user()->role  != 'Account', function ($q) {
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->toDateString();
$endOfCurrentMonth = Carbon::now()->endOfMonth()->toDateString();
    return $q->whereBetween('fees.month', [$startOfLastMonth, $endOfCurrentMonth]);
})
        ->leftJoin('fee_types', 'fee_types.id', '=', 'fees.fee_type_id')
        ->leftJoin('users', 'users.id', '=', 'fees.user_id')
        ->where('fee_type_id',1)
        ->get(['fees.*', 'fee_types.name as fee_type_name', 'users.name as student_name', 'phone', 'father_phone', 'father', 'course_name']);
        // return $reports;
        $view = view('backend.pages.report.date_wise_payment_report', compact('reports', 'startDate', 'endDate'))->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('general_details.pdf');
       }
}
