<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\Client;

class AuthController extends Controller {
    public function login( Request $request ) {
        $request->validate( [
            'email' => 'required|string|email',
            'password' => 'required|string',
            //'remember_me' => 'boolean|nullable'
        ] );
        
        $credentials = request( ['email', 'password'] );
        if ( !Auth::attempt( $credentials ) )
        return response()->json( [
            'message' => 'Unauthorized'
        ], 401 );
        $user = $request->user();
        $tokenResult = $user->createToken( 'Personal Access Token' );
        $token = $tokenResult->token;
        if ( $request->remember_me )
        $token->expires_at = Carbon::now()->addWeeks( 1 );
        $token->save();
        return response()->json( [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user'=> $request->user()
        ] );
    }
    // public function login(Request $request){
    //     $passwordGrantClient = Client::where('password_client',1)->first();
    //     $data = [
    //         'grant_type' => 'password',
    //         'client_id' => $passwordGrantClient->id,
    //         'client_secret' => $passwordGrantClient->secret,
    //         'username' => $request->email,
    //         'password' => $request->password,
    //         'scope' => '*'
    //     ];
    //     $tokenRequest = Request::create('/oauth/token','post', $data);
    //     return app()->handle($tokenRequest);
    // }
    public function validated( Request $request ) {
        $request->validate( [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean|nullable'
        ] );    
    }

    public function showRegistrationForm( Request $request ) {
        if ( $request->has( 'ref' ) ) {
            session( ['referrer' => $request->query( 'ref' )] );
        }

        return view( '/register' );
    }

    public function register( Request $request ) {
        $request->validate( [
            'name'      => ['required', 'string', 'max:255'],
            'surname'   => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'unique:users', 'alpha_dash', 'min:3', 'max:30'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'cellphone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:7', 'max:30'],
            // 'ipAddress' => ['required', 'ip'],
            'country_id'=> ['required', 'integer'],
            'referrer_id'=> ['nullable', 'integer'],
            'terms'=> ['required']
        ] );

        return User::create( [
            'name'        => $request->name,
            'surname'     => $request->surname,
            'username'    => $request->username,
            'email'       => $request->email,
            'referrer_id' => $request->referrer_id,
            'password'    => Hash::make( $request->password ),
            'cellphone'   => $request->cellphone,
            'country_id'  => $request->country_id,
            'ipAddress'   => $request->ipAddress,
        ] );
    }

    public function user( Request $request ) {
        return response()->json( $request->user() );
    }

    public function change_password( Request $request ) {
        $user = auth('api')->user(); 
         
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'old_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
        ]);
        $user->password = Hash::make( $request->password );
        $user->save();
        if($user->save()){
            return response()->json(['message' => 'Password Change successfully'], 200);        
        }
        else{
            return response()->json(['message' => 'Failed to change password'], 401);
        }      
    }

}
