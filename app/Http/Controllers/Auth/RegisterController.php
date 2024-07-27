<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirectTo(): string
    {
        $this->redirectTo = RouteServiceProvider::AFTERREGISTER;
        return $this->redirectTo;
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
            'religion' => $data['religion'],
            'marital_status' => $data['marital_status'],
            'signature' => $data['signature'] ?? null,
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
    public function showRegistrationForm()
    {
        $divisions = Division::all();
        return view('auth.register')->with('divisions', $divisions);
    }
}
