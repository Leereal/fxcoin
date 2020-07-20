<?php

namespace App\Http\Controllers;

use App\PendingPayment;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Resources\PendingPaymentResource;

class PendingPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pending_payments = PendingPayment::paginate();
        return PendingPaymentResource::collection($pending_payments);
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
            'market_place_id'   => 'required|integer',            
            'comments'          => 'required|max:1000|nullable',           
        ]);
        $pending_payment                          = new PendingPayment;
        $pending_payment->amount                  = $request->input('amount');
        $pending_payment->market_place_id         = $request->input('market_place_id');
        $pending_payment->transaction_code        = Carbon::now()->timestamp;//. '-' . Auth::user()->id;      
        $pending_payment->user_id                 = $request->input('user_id');//Auth::user()->id
        $pending_payment->comments                = $request->input('comments');
        $pending_payment->expiration_time         = Carbon::now()->addHours(24);
        $pending_payment->ipAddress               = request()->ip();  
        if($pending_payment->save()){
            return new PendingPaymentResource($pending_payment);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PendingPayment  $pendingPayment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pending_payment = PendingPayment::findOrFail($id);

        //Return single pending_payment as a resource
        return new PendingPaymentResource($pending_payment);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PendingPayment  $pendingPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PendingPayment $pendingPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PendingPayment  $pendingPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pending_payment = PendingPayment::findOrFail($id);

       if($pending_payment->delete()){
            return new PendingPaymentResource($pending_payment);   
       }
    }
  
}
