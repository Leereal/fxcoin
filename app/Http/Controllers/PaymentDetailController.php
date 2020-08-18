<?php

namespace App\Http\Controllers;

use App\PaymentDetail;
use Illuminate\Http\Request;

use App\Http\Resources\PaymentDetailResource;

class PaymentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_details = PaymentDetail::paginate();
        return PaymentDetailResource::collection($payment_details);
    }

    public function user_payment_details()
    {
        $user_payment_details = PaymentDetail::where('user_id',auth('api')->user()->id)->paginate();
        return PaymentDetailResource::collection($user_payment_details);
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
            'payment_method_id' => 'required|integer',
            'account_number'    => 'required|max:255',  
            'branch'    => 'max:30',           
        ]);
        $payment_detail                     =   new PaymentDetail;
        $payment_detail->user_id            =   auth('api')->user()->id;         
        $payment_detail->payment_method_id  =   $request->input('payment_method_id'); 
        $payment_detail->account_number     =   $request->input('account_number');
        $payment_detail->branch             =   $request->input('branch');        
        $payment_detail->ipAddress          =   request()->ip();
        if($payment_detail->save()){
            return new PaymentDetailResource($payment_detail);
        }    
    }

    public function show($id)
    {      
       $payment_detail = PaymentDetail::findOrFail($id);

       //Return single payment_detail as a resource
       return new PaymentDetailResource($payment_detail);
    }
   
    public function update(Request $request, PaymentDetail $payment_detail)
    {
        //Validate input values
        $request->validate([  
            'account_number'    => 'required|max:255',
            'ipAddress'         => 'required|ip',
        ]);

        $payment_detail                 = PaymentDetail::findOrFail($request->id);
        $payment_detail->id             = $request->input('id');       
        $payment_detail->account_number = $request->input('account_number');       
        $payment_detail->ipAddress      = request()->ip();
        if($payment_detail->save()){
            return new PaymentDetailResource($payment_detail);
        }    
    }

    public function destroy($id)
    {
        $payment_detail = PaymentDetail::findOrFail($id);

       if($payment_detail->delete()){
            return new PaymentDetailResource($payment_detail);   
       }

       
    }
}
