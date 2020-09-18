<?php

namespace App\Http\Controllers;

use App\Http\Resources\MarketPlaceResource;
use App\ReferralBonus;
use Illuminate\Http\Request;

use App\Http\Resources\ReferralBonusResource;
use App\MarketPlace;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReferralBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referral_bonus = ReferralBonus::paginate();
        return ReferralBonusResource::collection($referral_bonus);
    }

    public function user_referral_bonus()
    {
        $referral_bonuses = ReferralBonus::where('user_id',auth('api')->user()->id)->get();
        return ReferralBonusResource::collection($referral_bonuses);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bonus()
    {
        $user       =     auth('api')->user();
        return $user->referral_bonuses()->active()->sum('amount');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function withdrawal(Request $request)
    {
        $request->validate([
            'payment_detail_id' => 'required|integer',     
        ]);

        //Take referral bonuses not withdrawn
        $user       =     auth('api')->user();
        $bonus      =       $user->referral_bonuses()->active()->sum('amount');   
        
        // //Check if remaining bonus is not zero 
        if ($bonus == 0 ) {
            $rdata = array(
                'status' => 'error',
                'message' => 'You  have ' . $bonus . 'vpoints bonus to withdraw'
            );
            return response()->json($rdata, 405);
        }

        // //Check if remaining bonus is bigger than R400 
        if($user->currency->name == 'ZAR' && $bonus < 400){
            $rdata = array(
                'status' => 'error',
                'message' => 'You  have ' . $bonus . 'vpoints bonus to withdraw. Minimum allowed is 400'
            );
            return response()->json($rdata, 405);
        }

        // //Check if remaining bonus is bigger than $25 
        if($user->currency->name == 'USD' && $bonus < 25){
            $rdata = array(
                'status' => 'error',
                'message' => 'You  have ' . $bonus . 'vpoints bonus to withdraw. Minimum allowed is 25'
            );
            return response()->json($rdata, 405);
        }
        //------------Start transaction------------------//  
        //Daily Minimum and Maximum withdrawal       
        $min_amount = $user->currency->name == 'ZAR' ? 400 : 25;
        $max_amount = $user->currency->name == 'ZAR' ? 32000 : 2000;

        //Get current users points in market place
        $user_market_place_balance = $user->market_places()->where('status','<>', 100)->get()->sum('balance');

        //Check if user has not exceeded maximum required in market place
        if (($user_market_place_balance + $bonus) > $max_amount) {
            $rdata = array(
                'status' => 'error',
                'message' => 'Limit Reached.  You still have '.$user_market_place_balance.' on Market.'
            );
            return response()->json($rdata, 405);
        }
      
        try {
            DB::beginTransaction();
            $market_place                          = new MarketPlace();
            $market_place->amount                  = $bonus;
            $market_place->balance                 = $bonus;
            $market_place->reason                  = 'Referral Bonus';
            $market_place->transaction_code        = Carbon::now()->timestamp. '-' . $user->id;
            $market_place->payment_detail_id       = $request->input('payment_detail_id');
            $market_place->investment_id           = 1;
            $market_place->user_id                 = $user->id;          
            $market_place->ipAddress               = request()->ip();
            $market_place->save();
            
            $user->referral_bonuses()->active()->update(['status' => 0]);

            DB::commit();
            return new MarketPlaceResource($market_place);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
      
        
    }

   
    public function destroy(ReferralBonus $referralBonus)
    {
        //
    }
}
