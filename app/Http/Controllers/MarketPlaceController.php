<?php

namespace App\Http\Controllers;

use App\MarketPlace;
use App\Settings;
use Illuminate\Http\Request;
use App\Http\Resources\MarketPlaceResource;
use DB;
use App\Investment;
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
                $query->where('user_id','<>' , auth('api')->user()->currency_id);
            })
            ->with('payment_detail')->active()->paginate(8);

            if(!$marketplaces){
                $rdata= array(
                    'status' => 'error',
                    'message' => 'No more points available for sale. Please wait for the Market to open again'
                );
                return response()->json($rdata, 403);
            }       
            return MarketPlaceResource::collection($marketplaces);
        }
        else {
            $rdata= array(
                'status' => 'error',
                'message' => 'Market is currently closed. Please wait for the market to open. You can also buy points directly from the system and get high interest, this increase FXAuction equity for trading Forex and Binary Options which generates profits for the benefit of every member of this platform. REMEMBER WE MAKE OUR PROFITS FROM TRADING MONEY DEPOSITED VIA POOL OPTIONS TO SUPPORT THE SYSTEM'
            );
            return response()->json($rdata, 403);
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
            'due_date'          => 'required',
            'comment'           => 'max:1000|nullable',
        ]);
        //------------Start transaction------------------//
        $balance = $request->input('balance');
        $amount  = $request->input('amount');
        $due_date  = $request->input('due_date');

        $settings = Settings::where('id', 1)->first();
        $min_amount = $settings->min_withdrawal;
        $max_amount = $settings->max_withdrawal;


        if (($amount <= $balance) && ($amount!=0) && ($due_date < now()) && ($min_amount <= $amount) && ($max_amount >= $amount)) {
            $investment_balance = $balance-$amount;
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
            return response()->json($rdata, 500);
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
