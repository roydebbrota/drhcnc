<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Degree;
use App\Models\ChamberDayTime;
use App\Models\PublicationHistory;
use App\Models\JobHistory;
use App\Models\PackageItem;
use App\Models\PublicHoliday;
use App\Models\ChamberClosed;
use DB;
use Carbon\Carbon;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upozila;

class IndexController extends Controller
{
    // public function index(){
    //     return redirect()->route('login');
    // }
    public function index(){
        return view('frontend.pages.index');
    }

    public function getDistrict($division_id){
        $division = Division::find($division_id);
        $districts = $division->districts;
        $html = view('frontend.pages.students.get_district')->with(compact('districts'))->render();
        return response()->json($html);
    }
    public function getUpazila($district_id){
        $district = District::find($district_id);
        $upazilas = $district->upazilas;
        $html = view('frontend.pages.students.get_upazila')->with(compact('upazilas'))->render();
        return response()->json($html);
    }



}
