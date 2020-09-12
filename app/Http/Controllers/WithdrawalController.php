<?php

namespace App\Http\Controllers;

use App\Withdrawal;
use Illuminate\Http\Request;

use App\Http\Resources\WithdrawalResource;
use App\Investment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdrawals = Withdrawal::paginate();
        return WithdrawalResource::collection($withdrawals);
    }

    public function user_withdrawals()
    {
        $user = auth('api')->user();
        $withdrawals = $user->withdrawals()->latest()->get();
        return WithdrawalResource::collection($withdrawals);
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
        //Take balance and due date from investments
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

        //Get current users points in market place
        $user_withdrawal_balance = $user->withdrawals()->where('status', 2)->get()->sum('amount');

        //Checking if amount is less than available balance, amount is not zero, investment mature, transaction limit not exceeded or below
        if (($amount <= $balance) && ($amount!=0) && ($due_date < now()) && ($min_amount <= $amount) && ($max_amount >= $amount)) {
            $investment_balance = $balance-$amount;//Calculating balance to remain
             //Check if user has not exceeded maximum required in market place and withdrawals
             if (($user_market_place_balance + $user_withdrawal_balance + $amount) > $max_amount) {
                $rdata = array(
                    'status' => 'error',
                    'message' => 'Limit Reached.  You still have '.($user_market_place_balance + $user_withdrawal_balance) .' on Market and Withdrawals.'
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
                $withdrawal                          = new Withdrawal;
                $withdrawal->amount                  = $request->input('amount');
                $withdrawal->reason                  = $request->input('reason');
                $withdrawal->transaction_code        = Carbon::now()->timestamp. '-' .auth('api')->user()->id;
                $withdrawal->payment_detail_id       = $request->input('payment_detail_id');
                $withdrawal->investment_id           = $request->input('investment_id');
                $withdrawal->user_id                 = auth('api')->user()->id;
                $withdrawal->comments                = $request->input('comments');
                $withdrawal->ipAddress               = request()->ip();  
                $withdrawal->save();
                  
                //Reduce Investment
                $investment                            = Investment::findOrFail($request->input('investment_id'));
                $investment->balance                   = $investment_balance;
                $investment->status                    = $status;
                $investment->save();   
                DB::commit();
                return new WithdrawalResource($withdrawal);
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
        else{
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
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        //Return single withdrawal as a resource
        return new WithdrawalResource($withdrawal);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

       if($withdrawal->delete()){
            return new WithdrawalResource($withdrawal);   
       }
    }
}
