<?php

namespace App\Http\Controllers;

use App\Withdrawal;
use Illuminate\Http\Request;

use App\Http\Resources\WithdrawalResource;

use Carbon\Carbon;

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
            'reason'            => 'required|string|max:255',            
            'payment_detail_id' => 'required|integer',            
            'comments'          => 'required|max:1000|nullable',           
        ]);
        $withdrawal                          = new Withdrawal;
        $withdrawal->amount                  = $request->input('amount');
        $withdrawal->reason                  = $request->input('reason');
        $withdrawal->transaction_code        = Carbon::now()->timestamp;//. '-' . Auth::user()->id;
        $withdrawal->payment_detail_id       = $request->input('payment_detail_id');
        $withdrawal->user_id                 = $request->input('user_id');//Auth::user()->id
        $withdrawal->comments                = $request->input('comments');
        $withdrawal->ipAddress               = request()->ip();  
        if($withdrawal->save()){
            return new WithdrawalResource($withdrawal);
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
