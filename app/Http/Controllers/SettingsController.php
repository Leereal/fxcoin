<?php

namespace App\Http\Controllers;
use App\Settings;
use App\MarketPlace;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function open_market_place() {
        //Select All Market Place orders which are pending and set status to 1
        MarketPlace::where('status',2)->update(['status' => 1]);
        //Set open market to status 1
    return Settings::findOrFail(1)->update(['status' => 1]);
    }
    public function close_market_place() {
        return Settings::findOrFail(1)->update(['status' => 0]);
    }

    //Check if market is open
    public function market_open() {
        $res = Settings::where( 'id',1)->get();        
        return response()->json($res);
    }
}
