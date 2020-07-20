<?php

namespace App\Http\Controllers;

use App\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Resources\PaymentMethodResource;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {        
        $payment_methods = PaymentMethod::paginate();
        return PaymentMethodResource::collection($payment_methods);
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
            'name' => 'required|unique:payment_methods|max:255'
        ]);
        $payment_method =  new PaymentMethod;        
        $payment_method->name = $request->input('name');        
        if($payment_method->save()){
            return new PaymentMethodResource($payment_method);
        }    
    }

    public function show($id)
    {      
       $payment_method = PaymentMethod::findOrFail($id);

       //Return single payment_method as a resource
       return new PaymentMethodResource($payment_method);
    }
   
    public function update(Request $request, PaymentMethod $payment_method)
    {
        $request->validate([
            'name' => 'required|unique:payment_methods,name|max:255'.$payment_method->id,
        ]);
        $payment_method         =    PaymentMethod::findOrFail($request->id);
        $payment_method->id     =    $request->input('id');
        $payment_method->name   =    $request->input('name');        
        if($payment_method->save()){
            return new PaymentMethodResource($payment_method);
        }  
    }

    public function destroy($id)
    {
        $payment_method = PaymentMethod::findOrFail($id);

       if($payment_method->delete()){
            return new PaymentMethodResource($payment_method);   
       }

       
    }
}
