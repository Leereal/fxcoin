<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use App\User;
class VerificationController extends Controller
{
    use VerifiesEmails;
    /**
* Show the email verification notice.
*
*/
    public function show()
    {
//
    }
    /**
    * Mark the authenticated user’s email address as verified.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function verify(Request $request)
    {
        $userID = $request['id'];
        $user = User::findOrFail($userID);

        $user->email_verified_at = now();// to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
        $user->save();

        return redirect('login');
    }
    /**
    * Resend the email verification notification.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('User already have verified email!', 422);
            // return redirect($this->redirectPath());
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json('The notification has been resubmitted');
        // return back()->with(‘resent’, true);
    }
}
