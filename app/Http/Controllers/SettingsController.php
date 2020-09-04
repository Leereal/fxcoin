<?php

namespace App\Http\Controllers;

use App\Settings;
use App\MarketPlace;
use App\Investment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SettingsController extends Controller
{
    public function open_market_place()
    {
        $this->mature_investments();
        //Select All Market Place orders which are pending and set status to 1
        MarketPlace::where('status', 2)->update(['status' => 1]);
        //Set open market to status 1        
        return Settings::findOrFail(1)->update(['market_place_status' => 1]);
    }

    public function close_market_place()
    {
        return Settings::findOrFail(1)->update(['market_place_status' => 0]);
    }  

    public function mature_investments()
    {
        //Select All Investments with Due date passed and status 101 set to status 1
        return Investment::where('due_date','<=', now())->where('status', 101)->update(['status' => 1]);  
    }

    
}
