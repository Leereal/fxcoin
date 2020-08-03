<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

use App\Http\Controllers\Controller;
use App\Notifications\MailResetPasswordNotification;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Password;

class ApiForgotPasswordController extends Controller
{
    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }

    public function reset() {
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

    
}
