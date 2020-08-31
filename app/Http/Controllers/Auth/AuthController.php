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
use DB;
use App\Bonus;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean|nullable'
        ]);
         
        $credentials = request(['email', 'password']);
        if (!Auth::attempt(['email' => request()->email, 'password' => request()->password, 'status' => 1])) {
            return response()->json([
            'message' => 'Unauthorized'
        ], 401);
        }
        $user = $request->user();
        if ($user->email_verified_at != null) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            $token->save();            
            
            //Record session and device used to online users table
            $online = new \App\OnlineUser(['ipaddress' => request()->ip() ]);
            $user->online_users()->save($online);

            return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user'=> $request->user()           

        ]);
        } else {
            return response()->json(['error'=>'Please Verify Email'], 401);
        }
    }
    public function logout(Request $request)
    {
        //Set sign out session and device used to online users table
        $user = auth('api')->user();
        return $online = $user->online_users()->latest()->first()->update(['sign_out' => now(),'online_status' => 0]);
        // \App\OnlineUser::find(1)
        // $online = new \App\update(['sign_out' => now()]);
        // $user->online_users()->save($online);
        // $user = auth('api')->user();       
        // return $online = $user->online_users()->latest()->first()->update(['sign_out' => now()]);
    }
 
    public function validated(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean|nullable'
        ]);
    }

    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('/register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'surname'   => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'unique:users', 'alpha_dash', 'min:5', 'max:30'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8'],
            'confirm_password' => 'required|same:password',
            'cellphone' => ['required', 'string', 'unique:users', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:7', 'max:30'],
            'country_id'=> ['required', 'integer'],
            'currency_id'=> ['required', 'integer'],
            'referrer_id'=> ['nullable', 'integer'],
            'terms'=> ['required']
        ]);

        //Generate ShortLink using Cuttly (Email: fxauction2020@gmail.com Password: Mutabvuri$8)
        $shortLink ="";
        $key = "6721546ef96487e3ca1334d4cbf73489912d0";    
        $url_cuttly = "https://cutt.ly/api/api.php";
        $link = urlencode("https://fxauction.net/register?ref=".$request->username);
        $json = file_get_contents($url_cuttly."?key=$key&short=$link");
        $data = json_decode ($json, true);
        if($data["url"]["status"] == 7){
            $shortLink = $data["url"]["shortLink"];
        }       
        try {
            DB::beginTransaction();
            $user = User::create([
            'name'        => $request->name,
            'surname'     => $request->surname,
            'username'    => $request->username,
            'email'       => $request->email,
            'referrer_id' => $request->referrer_id,
            'password'    => Hash::make($request->password),
            'cellphone'   => $request->cellphone,
            'country_id'  => $request->country_id,
            'currency_id'  => $request->currency_id,
            'shortlink'  => $shortLink,
            'email_verified_at'  => now(),
            'ipAddress'   => request()->ip(),
            ]);            
            if($request->referrer_id>0){
            $referrer = User::where('id',$request->referrer_id)->first();
            $bonus = new Bonus;
            $bonus->user_id = $request->referrer_id;
            $bonus->amount  = ($referrer->currency_id =='2' ? 5 : 0.4);
            $bonus->description = "Registration Bonus for ".$request->username;
            $bonus->save();
            }          

            $user->sendApiEmailVerificationNotification();
            DB::commit();

            $success['message'] = 'Please confirm yourself by clicking on verify user button sent to you on your email';
            return response()->json(['success'=>$success], 200);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function change_password(Request $request)
    {
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
        $user->password = Hash::make($request->password);
        $user->save();
        if ($user->save()) {
            return response()->json(['message' => 'Password Change successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to change password'], 401);
        }
    }
}
