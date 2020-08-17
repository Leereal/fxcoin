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
        $investments = Investment::where('user_id', auth('api')->user()->id)->with('package', 'referral_bonus', 'user', 'payment_method')->orderBy('id', 'desc')->paginate();
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
            'pop'               => 'required',
            'comment'          => 'max:1000|nullable',
        ]);

        $user = auth('api')->user();
        $referrer   = User::find($user->id)->referrer_id;

        //Get pending order with posted id
        //$pending_payment = PendingPayment::where('id', $request->input('id'))->first();

        //Get package of the  pending order
        $package    = Packages::findOrFail($request->input('package_id'));
        
        $amount = $request->amount;
        $expected_profit = $amount + ($package->interest /100 * $amount);
        $balance = $expected_profit;

        if ($amount >= $package->minimum) {
            try {
                DB::beginTransaction();

                $extension = explode('/', mime_content_type($request->pop))[1];
                $name = time()."-".auth('api')->user()->id.".".$extension;
                \Image::make($request->pop)->save(public_path('images/'.$name));

                //Add Investment
                $investment                          = new Investment;
                $investment->amount                  = $amount;
                $investment->description             = 'Deposit';
                $investment->package_id              = $package->id;
                $investment->transaction_code        = Carbon::now()->timestamp. '-' . $user->id;
                $investment->user_id                 = $user->id;
                $investment->comments                = $request->comment;
                $investment->due_date                = Carbon::now()->addDays($package->period);
                $investment->payment_method_id       = $request->payment_method_id;
                $investment->currency_id             = 1; //From settings table;
                $investment->pop                     = $name; //From settings table;
                $investment->ipAddress               = request()->ip();
                $investment->expected_profit         = $expected_profit;
                $investment->balance                 = $balance;
                $investment->status                  = 2;
                $investment->save();
                
                if ($referrer>0 && $referrer != $user->id) {
                    //Add bonus
                    $referral_bonus                      = new ReferralBonus;
                    $referral_bonus->user_id             = $referrer;
                    $referral_bonus->amount              = $amount*0.1;
                    $investment->referral_bonus()->save($referral_bonus);
                }
                DB::commit();
               
                return new InvestmentResource($investment);
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
        else {
            $rdata= array(
                'status' => 'error',
                'message' => 'Check if amount is between allowed minimum and maximum daily limit'
            );
            return response()->json($rdata, 500);
        }
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
