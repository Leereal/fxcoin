<?php

namespace App\Http\Controllers;

use App\MarketPlace;
use Illuminate\Http\Request;
use App\Http\Resources\MarketPlaceResource;
use DB;
use App\Investment;
use App\Settings;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;

class MarketPlaceController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index()
    {   
        $settings = Settings::where('id', 1)->first(); //Check if market place is allowed to open in settings 
        if ($settings->market_place_status > 0) {
            //View all sells in Market with same currency as the logged user
            $marketplaces = MarketPlace::whereHas('user', function (Builder $query){
                $query->where('currency_id', auth('api')->user()->currency_id);
                $query->where('user_id','<>' , auth('api')->user()->id);
            })
            ->with('payment_detail')->active()->orderByRaw('RAND()')->paginate(8);

            if($marketplaces->isEmpty()){
                return ['status' => 'Finished'];              
            }
            return MarketPlaceResource::collection($marketplaces);       
            
        }
        else {
            return ['status' => 'Closed'];
        }
    }

    public function user_pending_payments()
    {
        $market_places = MarketPlace::where('user_id', auth('api')->id)->with('pending_payments')->get();
        return MarketPlace::collection($market_places);
    }

    public function pending_payments()
    {
        $marketplaces = MarketPlace::with('pending_payments')->where('user_id', auth('api')->user()->id)->get();
        //Return all pending_payment for current user as a resource
        return MarketPlaceResource::collection($marketplaces);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $request->validate([
            'amount'            => 'required|max:10|between:0,99.99',
            'balance'           => 'required|max:10|between:0,99.99',
            'reason'            => 'required|string|max:255',
            'payment_detail_id' => 'required|integer',
            'investment_id'     => 'required|integer',
            'comment'           => 'max:1000|nullable',
        ]);

        //Take balance from investments
        $investment     = Investment::where('id',$request->investment_id)->first();
        $balance        = $investment->balance;
        $due_date       = $investment->due_date;

        //------------Start transaction------------------// 
        $amount  = $request->input('amount'); 
        
        //Daily Minimum and Maximum withdrawal
        $user = auth('api')->user();    
        $min_amount = $user->currency->name == 'ZAR' ? 150 : 10;
        $max_amount = $user->currency->name == 'ZAR' ? 32000 : 2000;

        //Get current users points in market place
        $user_market_place_balance = $user->market_places()->where('status','<>', 100)->get()->sum('balance');

        //Checking if amount is less than available balance, amount is not zero, investment mature, transaction limit not exceeded or below
        if (($amount <= $balance) && ($amount!=0) && ($due_date < now()) && ($min_amount <= $amount) && ($max_amount >= $amount)) {
            $investment_balance = $balance-$amount;//Calculating balance to remain

            //Check if user has not exceeded maximum required in market place
            if (($user_market_place_balance + $amount) > $max_amount) {
                $rdata = array(
                    'status' => 'error',
                    'message' => 'Limit Reached.  You still have '.$user_market_place_balance.' on Market.'
                );
                return response()->json($rdata, 405);
            }
            // //Check if remaining balance can be placed on market place again
            if (($investment_balance < $min_amount) && ($investment_balance != 0) ) {
                $rdata = array(
                    'status' => 'error',
                    'message' => 'You are recommended to take all the amount because remaining balance will be less than  ' . $min_amount
                );
                return response()->json($rdata, 405);
            }

            //Setting statuses to update investment
            if ($amount == $balance) {
                $status = 0;
            } else {
                $status = 1;
            }

            try {
                DB::beginTransaction();
                $market_place                          = new MarketPlace;
                $market_place->amount                  = $request->input('amount');
                $market_place->balance                 = $request->input('amount');
                $market_place->reason                  = $request->input('reason');
                $market_place->transaction_code        = Carbon::now()->timestamp. '-' . auth('api')->user()->id;
                $market_place->payment_detail_id       = $request->input('payment_detail_id');
                $market_place->investment_id           = $request->input('investment_id');
                $market_place->user_id                 = auth('api')->user()->id;
    
                $market_place->comment                 = $request->input('comment');
                $market_place->ipAddress               = request()->ip();
                $market_place->save();
    
                //Reduce Investment
                $investment                            = Investment::findOrFail($request->input('investment_id'));
                $investment->balance                   = $investment_balance;
                $investment->status                    = $status;
                $investment->save();
    
                DB::commit();
                return new MarketPlaceResource($market_place);
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } else {
            $rdata= array(
                'status' => 'error',
                'message' => 'Check if amount is between allowed minimum and maximum daily limit and also if it is above balance'
            );
            return response()->json($rdata, 405);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\MarketPlace  $marketPlace
    * @return \Illuminate\Http\Response
    */

    public function show($id)
    {
        $market_place = MarketPlace::findOrFail($id);

        //Return single withdrawal as a resource
        return new MarketPlaceResource($market_place);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\MarketPlace  $marketPlace
    * @return \Illuminate\Http\Response
    */

    public function update(Request $request, MarketPlace $marketPlace)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\MarketPlace  $marketPlace
    * @return \Illuminate\Http\Response
    */

    public function destroy($id)
    {
        $market_place = MarketPlace::findOrFail($id);

        if ($market_place->delete()) {
            return new MarketPlaceResource($market_place);
        }
    }
}
