<?php

namespace App\Http\Controllers;

use App\MarketPlace;
use Illuminate\Http\Request;
use App\Http\Resources\MarketPlaceResource;

use Carbon\Carbon;

class MarketPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marketplaces = MarketPlace::paginate();
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
            'reason'            => 'required|string|max:255',            
            'payment_detail_id' => 'required|integer',            
            'comments'          => 'required|max:1000|nullable',           
        ]);
        $market_place                          = new MarketPlace;
        $market_place->amount                  = $request->input('amount');
        $market_place->balance                 = $request->input('amount');
        $market_place->reason                  = $request->input('reason');
        $market_place->transaction_code        = Carbon::now()->timestamp;//. '-' . Auth::user()->id;
        $market_place->payment_detail_id       = $request->input('payment_detail_id');
        $market_place->user_id                 = $request->input('user_id');//Auth::user()->id
        $market_place->comments                = $request->input('comments');
        $market_place->ipAddress               = request()->ip();  
        if($market_place->save()){
            return new MarketPlaceResource($market_place);
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

       if($market_place->delete()){
            return new MarketPlaceResource($market_place);  
       }
    }
}
