<?php

namespace App\Http\Controllers\Auth\Api;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailableForgotPassword;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgot(Request $request) {
        $credentials = request()->validate(['email' => 'required|email']);
        $newpass = Str::random(10);
        $check = User::where('email', $request->email)->exists();
            if($check) {
                $usrid =  User::where('email', $request->email)->value('id');     
                $user_details = User::find($usrid);  
                $pg_email = (object) array("name"=>$user_details->name,"surname"=>$user_details->surname,"password"=>$newpass,"username"=>$request->email);
                $user_details->password = bcrypt($newpass);
                $user_details->save();
                Mail::to($request->email)->send(new SendMailableForgotPassword($pg_email));
            } 
        return response()->json(["msg" => 'Password reset successfully. Please check your email.']);
    }
    public function reset(Request $request) {
        $credentials = request()->validate([            
            'token' => 'required|string',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make( $password );
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return response()->json(["msg" => "Password has been successfully changed"]);
    }
    public function getReset($token = null ,Request $request)
	{
		if (is_null($token)){
            return response()->json(["msg" => "Invalid token provided"], 400);
        };
        
        // return view('auth.passwords.reset')->with(
        //     ['token' => $token, 'email' => $request->email]
        // );

     
		return "Error on password reset please contact support";
	}
}
