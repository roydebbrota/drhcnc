<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
public function resetPasswordPage(){
    return view('auth.passwords.reset');
}
public function changePassword(Request $request){
    $validated = $request->validate([
        'old_password' => ['required'],
        'password' => ['required','confirmed'],
    ]);
    $user = Auth::user();
    if(Hash::check($request->old_password, $user->password)){
        $user->update([
            'password'=> Hash::make($request->password)
        ]);
        toast('Password change successfully!','success')->autoClose(3000);
        return redirect()->route('student.dashboard');
    }else{
        toast('Did not match!','error')->autoClose(10000);
        return back();
    }

}
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
