<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Level;
use App\Models\GradingSystem;
use App\Models\EducationSummary;
use App\Models\DocumentUpload;
use App\Models\DocumentName;
use App\Models\DocumentType;
use App\Models\FeeType;
use App\Models\Fee;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use DataTables;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'course_name' => ['required', 'string', 'max:255'],
            'father' => ['required', 'string', 'max:255'],
            'mother' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:255', 'unique:users'],
            'division' => ['required'],
            'district' => ['required'],
            'session' => ['required'],
            'thana' => ['required'],
            'post_office' => ['required'],
            'village' => ['required'],
            'ssc_exam_name' => ['required'],
            'ssc_board' => ['required'],
            'ssc_roll' => ['required'],
            'ssc_reg_no' => ['required'],
            'ssc_gpa' => ['required'],
            'ssc_year' => ['required'],
            'hsc_exam_name' => ['required'],
            'hsc_board' => ['required'],
            'hsc_roll' => ['required'],
            'hsc_reg_no' => ['required'],
            'hsc_gpa' => ['required'],
            'hsc_year' => ['required'],
            'govt_exam_name' => ['required'],
            'govt_roll' => ['required'],
            'govt_score' => ['required'],
            'govt_serial' => ['required'],
            'govt_user_id' => ['required'],
            'govt_password' => ['required'],
            'nationality' => ['required'],
            'marital_status' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    protected function create(array $data)
    {
        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $image_name = Str::slug($data['name']) . '.' . $image->getClientOriginalExtension();
            $image_path = 'frontend/img/student/image' . request()->student_id . '/' . $image_name;
            $image->move(public_path('frontend/img/student/image' . request()->student_id . '/'), $image_name);
            $data['image'] = $image_path;
        }

        if (request()->hasFile('signature')) {
            $signature = request()->file('signature');
            $signature_name = Str::slug($data['name']) . '.' . $signature->getClientOriginalExtension();
            $signature_path = 'frontend/img/student/signature' . request()->student_id . '/' . $signature_name;
            $signature->move(public_path('frontend/img/student/signature' . request()->student_id . '/'), $signature_name);
            $data['signature'] = $signature_path;
        }
        $dateOfBirth = Carbon::parse($data['date_of_birth']);
        $data['date_of_birth'] = $dateOfBirth;

        // Generate unique slug
        $slug = Str::slug($data['name']);
        $slug = $this->generateUniqueSlug($slug);

        $data['slug'] = $slug;

        // Debugging step: Print the data to check the fields
        // dd($data);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('drhcnc123'),
            'course_name' => $data['course_name'],
            'session' => $data['session'],
            'name_bangla' => $data['name_bangla'],
            'father' => $data['father'],
            'mother' => $data['mother'],
            'phone' => $data['phone'],
            'father_phone' => $data['father_phone'],
            'date_of_birth' => $dateOfBirth,
            'blood_group' => $data['blood_group'],
            'nid_birth_reg' => $data['nid_birth_reg'],
            'nid_birth_reg_num' => $data['nid_birth_reg_num'],
            'hostel' => $data['hostel'],
            'division' => $data['division'],
            'district' => $data['district'],
            'upazila' => $data['upazila'],
            'thana' => $data['thana'],
            'post_office' => $data['post_office'],
            'post_code' => $data['post_code'],
            'village' => $data['village'],
            'present_address' => $data['present_address'],
            'ssc_exam_name' => $data['ssc_exam_name'],
            'ssc_board' => $data['ssc_board'],
            'ssc_roll' => $data['ssc_roll'],
            'ssc_reg_no' => $data['ssc_reg_no'],
            'ssc_gpa' => $data['ssc_gpa'],
            'ssc_year' => $data['ssc_year'],
            'hsc_exam_name' => $data['hsc_exam_name'],
            'hsc_board' => $data['hsc_board'],
            'hsc_roll' => $data['hsc_roll'],
            'hsc_reg_no' => $data['hsc_reg_no'],
            'hsc_gpa' => $data['hsc_gpa'],
            'hsc_year' => $data['hsc_year'],
            'govt_exam_name' => $data['govt_exam_name'],
            'govt_roll' => $data['govt_roll'],
            'govt_score' => $data['govt_score'],
            'govt_serial' => $data['govt_serial'],
            'govt_user_id' => $data['govt_user_id'],
            'govt_password' => $data['govt_password'],
            'nationality' => $data['nationality'],
            'marital_status' => $data['marital_status'],
            'signature' => $data['signature'] ?? null,
            'religion' => $data['religion'],
            'image' => $data['image'] ?? null,
            'slug' => $data['slug'],
        ]);
    }
    private function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
    public function registerStudent(Request $request)
    {
        // return $request;
        $this->validator($request->all())->validate();

        $student = $this->create($request->all());
        toast('Student Registered successfully!','success')->autoClose(3000);
        return back();
        // return redirect()->route('student.add')->with('success', 'Student registered successfully');
    }
    public function updateStudent(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'course_name' => ['required', 'string', 'max:255'],
            'father' => ['required', 'string', 'max:255'],
            'mother' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:255'],
            'division' => ['required'],
            'district' => ['required'],
            'session' => ['required'],
            'thana' => ['required'],
            'post_office' => ['required'],
            'village' => ['required'],
            'ssc_exam_name' => ['required'],
            'ssc_board' => ['required'],
            'ssc_roll' => ['required'],
            'ssc_reg_no' => ['required'],
            'ssc_gpa' => ['required'],
            'ssc_year' => ['required'],
            'hsc_exam_name' => ['required'],
            'hsc_board' => ['required'],
            'hsc_roll' => ['required'],
            'hsc_reg_no' => ['required'],
            'hsc_gpa' => ['required'],
            'hsc_year' => ['required'],
            'govt_exam_name' => ['required'],
            'govt_roll' => ['required'],
            'govt_score' => ['required'],
            'govt_serial' => ['required'],
            'govt_user_id' => ['required'],
            'govt_password' => ['required'],
            'nationality' => ['required'],
            'marital_status' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ],
        [
            'required'  => 'The field is required.'
        ]);

        $user = User::find($request->id);

    if (!$user) {
        toast('Student not found!','error')->autoClose(3000);
        return back();
    }
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        if (file_exists($user->image)) {
            unlink($user->image);

        }
        $image = $request->file('image');
        $image_name = Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
        $image_path = 'frontend/img/student/image/' . $request->student_id . '/' . $image_name;
        $image->move(public_path('frontend/img/student/image/' . $request->student_id . '/'), $image_name);
        $user->image = $image_path;
    }
    if ($request->hasFile('signature')) {
        $signature = $request->file('signature');
        if (file_exists($user->signature)) {
            unlink($user->signature);
        }
        $image_extension = $signature->getClientOriginalExtension();
        $image_name = Str::slug($user->name).''.$user->user_id. '.' . $image_extension;
        $image_path = 'frontend/img/document/' . $request->user_id . '/' . $image_name;
        $signature->move(public_path('frontend/img/document/' . $request->student_id . '/'), $image_name);
        $user->signature = $image_path;
    }
    $user->name = $request->name;
    $user->email = $request->email;
    $user->course_name = $request->course_name;
    $user->session = $request->session;
    $user->name_bangla = $request->name_bangla;
    $user->father = $request->father;
    $user->mother = $request->mother;
    $user->phone = $request->phone;
    $user->father_phone = $request->father_phone;
    $user->date_of_birth = Carbon::parse($request->date_of_birth);
    $user->blood_group = $request->blood_group;
    $user->nid_birth_reg = $request->nid_birth_reg;
    $user->nid_birth_reg_num = $request->nid_birth_reg_num;
    $user->hostel = $request->hostel;
    $user->division = $request->division;
    $user->district = $request->district;
    $user->upazila = $request->upazila;
    $user->thana = $request->thana;
    $user->post_office = $request->post_office;
    $user->post_code = $request->post_code;
    $user->village = $request->village;
    $user->present_address = $request->present_address;
    $user->ssc_exam_name = $request->ssc_exam_name;
    $user->ssc_board = $request->ssc_board;
    $user->ssc_roll = $request->ssc_roll;
    $user->ssc_reg_no = $request->ssc_reg_no;
    $user->ssc_gpa = $request->ssc_gpa;
    $user->ssc_year = $request->ssc_year;
    $user->hsc_exam_name = $request->hsc_exam_name;
    $user->hsc_board = $request->hsc_board;
    $user->hsc_roll = $request->hsc_roll;
    $user->hsc_reg_no = $request->hsc_reg_no;
    $user->hsc_gpa = $request->hsc_gpa;
    $user->hsc_year = $request->hsc_year;
    $user->govt_exam_name = $request->govt_exam_name;
    $user->govt_roll = $request->govt_roll;
    $user->govt_score = $request->govt_score;
    $user->govt_serial = $request->govt_serial;
    $user->govt_user_id = $request->govt_user_id;
    $user->govt_password = $request->govt_password;
    $user->nationality = $request->nationality;
    $user->marital_status = $request->marital_status;
    $user->contract_amount = $request->contract_amount;
    $user->note = $request->note;
    $user->update();
    if(Auth::user()->role === 'SuperAdmin'){
        toast('Student update successfuly!','success')->autoClose(3000);
        return redirect()->route('student.edit', $user->slug);
    }elseif(Auth::user()->role === 'Student'){
        toast('Profile update successfuly!','success')->autoClose(3000);
        return redirect()->route('profile.edit', $user->slug);
    }
        // return $request;
    }
    public function studentAdd(){
        $divisions = Division::all();
        return view('backend.pages.student.student_add')->with(compact('divisions'));
    }
    public function allStudent(){
        return view('backend.pages.student.student_all');
    }
    public function allStudentTable(Request $request){
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
                        if(Auth::user()->role === 'SuperAdmin'){
                            $btn = '<a class="btn btn-sm btn-danger" target="_blank"
                        href="'.route('student.edit', $student->slug).'"><i class="fa-solid fa-pen-to-square"></i></a>&nbsp;<a class="btn btn-sm btn-danger" target="_blank"
                        href="'.route('upload.student.document',$student->slug).'"><i class="fa-solid fa-expand"></i></a>&nbsp;<a class="btn btn-sm btn-danger" target="_blank"
                        href="'.route('upload.student.fee',$student->slug).'"><i class="fa-solid fa-sack-dollar"></i></a>';
                        }else{
                            $btn = '<a class="btn btn-sm btn-danger" target="_blank"
                        href="'.route('upload.student.fee',$student->slug).'"><i class="fa-solid fa-sack-dollar"></i></a>';
                        }

                        return $btn;
                    })
                    ->rawColumns(['action', 'full_name'])
                    ->make(true);
        }
    }
    public function editStudent($slug){
        $studentId = User::where('slug', $slug)->first();
        $divisions = Division::all();
        $division = Division::find($studentId->division);
        $districts = $division->districts;
        $district = District::find($studentId->district);
        $upazilas = $district->upazilas;
        return view('backend.pages.student.student_edit')->with(compact('studentId','divisions', 'districts', 'upazilas'));
    }
    public function dashboard(){
        $documents = DocumentUpload::where('document_uploads.user_id', Auth::user()->id)
        ->leftJoin('document_names', 'document_names.id', '=', 'document_uploads.document_name_id')
        ->get(['document_uploads.*', 'document_names.name as document_name']);
        // return $documents;
        $student = User::where('users.id', Auth::user()->id)
        ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
        ->leftJoin('districts', 'districts.id', '=', 'users.district')
                    ->get(['users.*', 'divisions.name as division_name', 'districts.name as district_name'])->first();
        $documentTypes = DocumentType::where('status', 'Active')->get();
        $documentNames = DocumentName::where('status', 'Active')->get();
            return view('backend.pages.student.dashboard')->with(compact('student', 'documents', 'documentNames', 'documentTypes'));

    }
    public function studentInfo(){
        $student = Student::where('user_id', Auth::user()->id)->first();
        if($student){
            return view('backend.pages.student_info')->with(compact('student'));
        }else{
            return view('backend.pages.student.student_info_first');
        }
    }
    public function studentFile(){
        $educationSummaries = EducationSummary::where('student_id', Auth::user()->id)->get();
        $documents = DocumentUpload::where('student_id', Auth::user()->id)->get();
        $levels = Level::all();
        $g_systems = GradingSystem::all();
        return view('backend.pages.student.student_summary')->with(compact('levels', 'g_systems', 'educationSummaries', 'documents'));
    }
    public function afterCompleted(){
        return view('backend.pages.student.after_register');
    }
    public function uploadDocument(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'name' => ['required'],
            'image' => ['required'],
        ],
        [
            'required'  => 'The field is required.'
        ]);
        // return $request;
        $documentNames = DocumentName::find($request->name);
        //check document exist or not
        $checkExistOrNot = DocumentUpload::where('user_id', $request->student_id)
        ->where('document_name_id', $request->name)->first();
        if($checkExistOrNot){
            toast('This document allready uploaded!','error')->autoClose(6000);
            return back();
        }
        $document = new DocumentUpload();
        $document->user_id = $request->student_id;
        $document->document_name_id = $request->name;
        $document->uploader_id = Auth::user()->id;
        $image = $request->file('image');
        if($image){
            $image_name = Str::slug($documentNames->name).''.$request->student_id.'.'.$image->getClientOriginalExtension();
            $image_path = 'frontend/img/document/'.$request->student_id.'/'. $image_name;
            $request->image->move(public_path('frontend/img/document/'.$request->student_id.'/'),$image_name);
            $document->document = $image_path;
        }
        $document->save();
        toast('Document Uploaded successfully!','success')->autoClose(3000);
        return back();
    }

    public function updateDocument(Request $request){
        $validatedData = $request->validate([
            'u_image' => 'required', // Added 'image' validation for better validation
        ], [
            'required' => 'The field is required.',
        ]);

        $pre_document = DocumentUpload::find($request->document_id);

        if ($request->hasFile('u_image')) {
            $image = $request->file('u_image');

            // Check if the previous document exists and delete it
            if (file_exists($pre_document->document)) {
                unlink($pre_document->document);
            }

            // Generate a new image name
            $image_extension = $image->getClientOriginalExtension();
            $image_name = Str::slug($pre_document->name).''.$pre_document->user_id. '.' . $image_extension; // Use a unique ID to avoid overwriting

            // Define the image path
            $image_path = 'frontend/img/document/' . $pre_document->user_id . '/' . $image_name;

            // Move the uploaded image to the defined path
            $image->move(public_path('frontend/img/document/' . $pre_document->user_id . '/'), $image_name);

            // Update the document path in the database
            $pre_document->document = $image_path;
        }

        $pre_document->update();

        toast('Document changed successfully!', 'success')->autoClose(3000);

        return back();
    }
    public function uploadStudentDocument($slug){
        $getStudent = User::where('slug',$slug)->first();
        // return $getStudent;
        $documents = DocumentUpload::where('document_uploads.user_id', $getStudent->id)
            ->leftJoin('document_names', 'document_names.id', '=', 'document_uploads.document_name_id')
            ->leftJoin('users', 'users.id', '=', 'document_uploads.uploader_id')
            ->get(['document_uploads.*', 'document_names.name as document_name', 'users.name as uploder']);
            // return $documents;
            $student = User::where('users.id', $getStudent->id)
            ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
            ->leftJoin('districts', 'districts.id', '=', 'users.district')
                        ->get(['users.*', 'divisions.name as division_name', 'districts.name as district_name'])->first();
            $documentNames = DocumentName::where('status', 'Active')->get();
                return view('backend.pages.student.student_document_upload')->with(compact('student', 'documents', 'documentNames'));
    }
    public function uploadStudentFee($slug){
        $getStudent = User::where('slug',$slug)->first();
        $fees = Fee::where('fees.user_id', $getStudent->id)
            ->when(Auth::user()->role  == 'Account', function ($q) {
                $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->toDateString();
            $endOfCurrentMonth = Carbon::now()->endOfMonth()->toDateString();
            return $q->whereBetween('fees.created_at', [$startOfLastMonth, $endOfCurrentMonth]);
        })
            ->leftJoin('users as uploader', 'uploader.id', '=', 'fees.uploader_id')
            ->leftJoin('fee_types as fee_type', 'fee_type.id', '=', 'fees.fee_type_id')
            ->get([
                'fees.*',
                // 'student.name as student_name',
                'uploader.name as uploader_name',
                'fee_type.name as fee_type_name',
            ]);
        $student = User::where('users.id', $getStudent->id)
        ->leftJoin('divisions', 'divisions.id', '=', 'users.division')
        ->leftJoin('districts', 'districts.id', '=', 'users.district')
                    ->get(['users.*', 'divisions.name as division_name', 'districts.name as district_name'])->first();
        $feeTypes = FeeType::where('status', 'Active')->get();
        $userRole = Auth::user()->role;
        $paidFees = Fee::where('fees.user_id', $getStudent->id)->where('fee_type_id', 1)->sum('amount');
        $onAdmision= Fee::where('fees.user_id', $getStudent->id)->where('fee_type_id', 6)->first();
        if($onAdmision){
            $onAdmisionFees = $onAdmision->amount;
        }else{
            $onAdmisionFees = 0;
        }
        $withoutOnAdmisionFees =  $getStudent->contract_amount - $onAdmisionFees;

        if($getStudent->course_name == 'BSc Nursing (Basic)'){
            $totalYear = 4;
        }elseif($getStudent->course_name =='BSc Nursing (Post Basic)'){
            $totalYear = 2;
        }else{
            $totalYear = 3;
        }
        $yearlyAmount = $withoutOnAdmisionFees/$totalYear;
        // return $yearlyAmount;
        if($yearlyAmount < $paidFees){
            $completedPayment = '1st Year Paid, 2nd Year Due' .round($yearlyAmount-$paidFees) ;
        }elseif($yearlyAmount*2 < $paidFees){
            $completedPayment = '2nd Year Paid, 3nd Year Due' .round($yearlyAmount-$paidFees) ;
        }elseif($yearlyAmount*3 < $paidFees){
            $completedPayment = '3rd Year Paid, 4nd Year Due' .round($yearlyAmount-$paidFees) ;
        }elseif(($yearlyAmount > $paidFees)){
            $completedPayment = '1st Year Due = '.round($yearlyAmount-$paidFees) ;
        }else{
            $completedPayment = round($yearlyAmount);
        }
        // return $paidFees;
        // $remainingFees =
        return view('backend.pages.student.upload_student_fee')->with(compact('student', 'fees','feeTypes', 'userRole', 'completedPayment', 'withoutOnAdmisionFees', 'paidFees', 'onAdmisionFees'));
    }
    public function collectStudentFee(Request $request){
        $validator = $request->validate([
            'student_id' => ['required'],
            'type' => ['required'],
            'amount' => ['required'],
            'date' => ['required'],
        ],[
            'student_id.required'=> 'Required',
            'type.required'=> 'Required',
            'amount.required'=> 'Required',
            'date.required'=> 'Required',
        ]);
        $collect = new Fee();
        $collect->user_id = $request->student_id;
        $collect->fee_type_id = $request->type;
        $collect->amount = $request->amount;
        $collect->month = Carbon::parse($request->date);
        $text = strip_tags($request->note);

    // Remove special characters
        $collect->note = preg_replace('/[^A-Za-z0-9\s]/', '', $text);
        $collect->uploader_id = Auth::user()->id;

        // return $collect;
        $collect->save();
        // $date = Carbon::createFromFormat('m/Y', $request->date);
        // return $collect;
        toast('Fees collect successfully!', 'success')->autoClose(3000);
        return back();
    }
    public function uploadStudentImage(Request $request){
        $user = User::find($request->student_id);
            // return $user;

        if (!$user) {
            toast('Student not found!','error')->autoClose(3000);
            return back();
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (file_exists($user->image)) {
                unlink($user->image);

            }
            $image = $request->file('image');
            $image_name = Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image_path = 'frontend/img/student/image/' . $request->student_id . '/' . $image_name;
            $image->move(public_path('frontend/img/student/image/' . $request->student_id . '/'), $image_name);
            $user->image = $image_path;
        }
        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            if (file_exists($user->signature)) {
                unlink($user->signature);
            }
            $image_extension = $signature->getClientOriginalExtension();
            $image_name = Str::slug($user->name).''.$request->student_id. '.' . $image_extension;
            $image_path = 'frontend/img/student/signature/' . $request->student_id. '/' . $image_name;
            $signature->move(public_path('frontend/img/student/signature/' . $request->student_id . '/'), $image_name);
            $user->signature = $image_path;
        }
        $user->update();
        toast('Image Upload successfully!', 'success')->autoClose(3000);
        return back();
    }
    public function studentProfileEdit(){
        $studentId = User::find(Auth::user()->id);
        $divisions = Division::all();
        $division = Division::find($studentId->division);
        $districts = $division->districts;
        $district = District::find($studentId->district);
        $upazilas = $district->upazilas;
        return view('backend.pages.student.student_profile_edit')->with(compact('studentId','divisions', 'districts', 'upazilas'));
    }
    public function updateStudentFee(Request $request){
        $id = $request->post_data['fees_id'];
        $amount = $request->post_data['amount'];
        $date = $request->post_data['date'];
        $note = $request->post_data['note'];
        $type = $request->post_data['fees_type'];
        $fees = Fee::find($id);
        $fees->amount = $amount;
        $fees->month = Carbon::parse($date);
        $fees->note = $note;
        $fees->fee_type_id = $type;
        $fees->update();
        return response()->json('success');
    }
}
