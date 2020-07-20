<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

//Import this resource to be able to use resources
use App\Http\Resources\CurrencyResource;

class CurrencyController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {        
        $currencies = Currency::paginate();
        return CurrencyResource::collection($currencies);
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
            'name'      => 'required|unique:currencies,name|max:255',
            'symbol'    => 'required|max:10'
        ]);
        $currency =  new Currency;        
        $currency->name = $request->input('name'); 
        $currency->symbol = $request->input('symbol');       
        if($currency->save()){
            return new CurrencyResource($currency);
        }    
    }

    public function show($id)
    {      
       $currency = Currency::findOrFail($id);

       //Return single payment_method as a resource
       return new CurrencyResource($currency);
    }
   
    public function update(Request $request, Currency $currency)
    {
        $request->validate([         
            'name'      => 'required|unique:currencies,name|max:255'.$currency->id,
            'symbol'    => 'required|max:10'
        ]);

        $currency           = Currency::findOrFail($request->id);
        $currency->name     = $request->input('name'); 
        $currency->symbol   = $request->input('symbol');       
        if($currency->save()){
            return new CurrencyResource($currency);
        }    
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);

       if($currency->delete()){
            return new CurrencyResource($currency);   
       }

       
    }
}
