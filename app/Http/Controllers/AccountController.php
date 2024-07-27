<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'phone' => ['required', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }
    protected function create(array $data)
    {
        // Generate unique slug
        $slug = Str::slug($data['name']);
        $slug = $this->generateUniqueSlug($slug);
        $data['slug'] = $slug;

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('drhcnc123'),
            'phone' => $data['phone'],
            'role' => $data['role'],
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
    public function usersave(Request $request)
    {
        // return $request;
        $this->validator($request->all())->validate();

        $student = $this->create($request->all());
        toast('User successfully!','success')->autoClose(4000);
        return back();
    }
    public function userCreate(){
        return view('backend.pages.account.account_user_create');
    }
    public function dashboard(){
        return view('backend.pages.account.dashboard');
    }
    public function accountAllStudent(){
        return view('backend.pages.account.all_student');
    }

}
