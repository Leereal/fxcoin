<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usd = App\Currency::create(['name'=>'USD','symbol'=>'US$']);
        $zar = App\Currency::create(['name'=>'ZAR','symbol'=>'R']);
        $btc = App\Currency::create(['name'=>'BTC','symbol'=>'₿']);
        $zwl = App\Currency::create(['name'=>'ZWL','symbol'=>'ZWL$']);
        $gbp = App\Currency::create(['name'=>'GBP','symbol'=>'£']);

        // //Attaching Countries to user
        // $usd->countries()->attach(rand(1,5));
        // $zar->countries()->attach(rand(1,5));
        // $btc->countries()->attach(rand(1,5)); 
        // $zwl->countries()->attach(rand(1,5));
        // $gbp->countries()->attach(rand(1,5));
        
    }
}
