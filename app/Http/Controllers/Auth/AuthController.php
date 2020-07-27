<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\Client;

class AuthController extends Controller
{
    
    public function login(Request $request){
        $passwordGrantClient = Client::where('password_client',1)->first();
        $data = [
            'grant_type' => 'password',
            'client_id' => $passwordGrantClient->id,
            'client_secret' => $passwordGrantClient->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*'
        ];
        $tokenRequest = Request::create('/oauth/token','post', $data);
        return app()->handle($tokenRequest);
    }

    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'surname'   => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'unique:users', 'alpha_dash', 'min:3', 'max:30'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'cellphone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/','min:7', 'max:30'],
            'ipAddress' => ['required', 'ip'],
            'country_id'=> ['required', 'integer']
        ]);

        return User::create([
            'name'        => $request->name,
            'surname'     => $request->surname,
            'username'    => $request->username,
            'email'       => $request->email,
            //'referrer_id' => $referrer ? $referrer->id : null,
            'password'    => Hash::make($request->password),
            'cellphone'   => $request->cellphone,
            'country_id'  => $request->country_id,
            'ipAddress'   => $request->ipAddress,  
            ]);
    }
    
}
