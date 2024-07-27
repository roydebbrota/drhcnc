<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institute;
use App\Models\User;
use DataTables;
use auth;

class InstituteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function instituteAdd(){
        return view('backend.pages.institute.institute_add');
    }
    public function instituteSave(Request $request){
        $validator = $request->validate([
            'name' => ['required', 'string'],
            'about' => ['required', 'string'],
            'type' => ['required', 'string']
        ],[
            'name.required'=> 'Required',
            'about.required'=> 'Required',
            'type.required'=> 'Required',
        ]);
        // return $request;
        $institute = new Institute();
        $institute->name = $request->name;
        $institute->type = $request->type;
        $institute->about = $request->about;
        $institute->established = $request->established;
        $institute->ranking = $request->ranking;
        $institute->user_id = Auth::user()->id;;
        $institute->save();
        toast('Institute save successfully!','success')->autoClose(3000);
        return back();
    }
    public function allInstitute(){
        return view('backend.pages.institute.institute_all');
    }
    public function allInstituteTable(Request $request){
        if ($request->ajax()) {
            $data = Institute::orderBy('name', 'asc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
                    // ->addColumn('full_name', function($student){
                    //     $fullName = $student->first_name.' '.$student->last_name;
                    //     return $fullName;
                    // })
                    ->editColumn('user_id', function($institute){
                        $user_id = $institute->user_id;
                        $user = User::find($user_id);
                        return $user->name;
                    })
                    ->addColumn('action', function($institute){
                        $btn = '<a class="btn btn-sm btn-danger" target="_blank"
                        href="'.route('edit.institute.info', $institute->id).'"><i class="fa-solid fa-pen-to-square"></i></a>&nbsp;';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }
    public function editInstitute($instituteId){
        $institute = Institute::find($instituteId);
        return view('backend.pages.institute.institute_edit')->with(compact('institute'));
    }
    public function updateInstitute(Request $request){
        // return $request;
        $institute = Institute::find($request->id);
        // return $institute;
        $institute->name = $request->name;
        $institute->type = $request->type;
        $institute->established = $request->established;
        $institute->ranking = $request->ranking;
        $institute->about = $request->about;
        $institute->update();
        toast('Institute save successfully!','success')->autoClose(3000);
        return back();
    }
}
