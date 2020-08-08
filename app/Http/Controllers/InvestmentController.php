<?php

namespace App\Http\Controllers;

use App\Investment;
use App\Packages;
use App\ReferralBonus;
use App\User;
use Illuminate\Http\Request;
use DB;

use Carbon\Carbon;

use App\Http\Resources\InvestmentResource;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investments = Investment::with('package', 'referral_bonus', 'user', 'payment_method')->active()->orderBy('id', 'desc')->paginate();
        return InvestmentResource::collection($investments);
    }

    public function investments()
    {
        $investments = Investment::where('user_id',auth('api')->user()->id)->with('package', 'referral_bonus', 'user', 'payment_method')->orderBy('id', 'desc')->paginate();
        return InvestmentResource::collection($investments);
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
            'package_id'        => 'required|integer',
            'payment_method_id' => 'required|integer',
            //'pop'               => 'mimes:pdf,jpeg,jpg,png,gif|max:10000|nullable',
            'comment'          => 'required|max:1000|nullable',
        ]);

        //------------Start transaction------------------//
        try {
            DB::beginTransaction();
            //Get due date
            $package    = Packages::findOrFail($request->input('package_id'));
            //Check if user was referred
            $referrer   = User::findOrFail($request->input('user_id'))->referrer_id;
            $user = auth('api')->user();
            //Add Investment
            $investment                          = new Investment;
            $investment->amount                  = $request->input('amount');
            $investment->description             = 'Deposit';
            $investment->package_id              = $request->input('package_id');
            $investment->transaction_code        = Carbon::now()->timestamp;//. '-' . Auth::user()->id;
            $investment->user_id                 = $user->id;
            $investment->comments                = $request->input('comment');
            $investment->due_date                = Carbon::now()->addDays($package->period);
            $investment->payment_method_id       = $request->input('payment_method_id');
            $investment->currency_id             = 1; //From settings table;
            $investment->pop                     = "hghgjhghjkgjjkhjhjhhj";
            $investment->ipAddress               = request()->ip();
            $investment->expected_profit         = $request->input('amount') + ($package->period * $package->daily_interest /100 * $request->input('amount'));
            $investment->balance                 = $request->input('amount') + ($package->period * $package->daily_interest /100 * $request->input('amount'));
            $investment->save();
            
            if ($referrer>0) {
                //Add bonus
                $referral_bonus                      = new ReferralBonus;
                $referral_bonus->user_id             = $referrer;
                $referral_bonus->amount              = $request->input('amount')*0.1;
                $investment->referral_bonus()->save($referral_bonus);
            }
            DB::commit();
            return new InvestmentResource($investment);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    
        // if(){
        //     return new InvestmentResource($investment);
        // }
        //------------End transaction------------------//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investment = Investment::findOrFail($id);

        //Return single investment as a resource
        return new InvestmentResource($investment);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $investment = Investment::findOrFail($id);

        if ($investment->delete()) {
            return new InvestmentResource($investment);
        }
    }
}
