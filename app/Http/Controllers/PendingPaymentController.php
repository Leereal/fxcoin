<?php

namespace App\Http\Controllers;

use App\PendingPayment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;
//use Laravel\Passport\Client;

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
            'amount'              => 'required|max:10|between:0,99.99',                        
            'market_place_id'     => 'required|integer',
            'payment_method_id'   => 'required|integer', 
            'package_id'          => 'required|integer',             
            'comment'             => 'max:1000|nullable',           
        ]);
        $user = auth('api')->user();
        $pending_payment                          = new PendingPayment;
        $pending_payment->amount                  = $request->input('amount');
        $pending_payment->market_place_id         = $request->input('market_place_id');
        $pending_payment->payment_method_id       = $request->input('payment_method_id');
        $pending_payment->package_id              = $request->input('package_id');
        $pending_payment->transaction_code        = Carbon::now()->timestamp. '-' . $user->id;      
        $pending_payment->user_id                 = $user->id;
        $pending_payment->comment                 = $request->input('comment');
        $pending_payment->expiration_time         = Carbon::now()->addHours(12);
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

    public function offers()
    {
        $user = auth('api')->user()->id;
        $offers = PendingPayment::where('user_id','=',$user)->where('status','=','2')->paginate();

        //Return single pending_payment as a resource
        return PendingPaymentResource::collection($offers);
    }

    public function make_payment( Request $request ) {
        $request->validate([
            'id'                  => 'required|integer',
            'comment'             => 'required|max:1000|nullable',  
        ]);
        $make_payment            = PendingPayment::findOrFail($request->id);
        $make_payment->id        = $request->input('id');
        $make_payment->comment   = $request->input('comment');
        $make_payment->status    = 101;
        // $make_payment->pop    = $request->input('pop');          
        if($make_payment->save()){
            return ['message'=>'Saved Successfully'];
        }  
    }

    public function approve_payment( Request $request ) {
        $request->validate([
            'id'                  => 'required|integer',            
        ]);
        $make_payment            = PendingPayment::findOrFail($request->id);
        $make_payment->id        = $request->input('id');  
        $make_payment->status    = 0;
        // $make_payment->pop    = $request->input('pop');          
        if($make_payment->save()){
            return ['message'=>'Saved Successfully'];
        }  
    }

  
}
