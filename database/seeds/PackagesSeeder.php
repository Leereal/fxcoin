<?php

use Illuminate\Database\Seeder;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Packages::create(['name'=>'Silver','minimum'=>'10','daily_interest'=>'3.6','interest'=>'25','period'=>'7','category'=>'Peer to Peer']);
        App\Packages::create(['name'=>'Gold','minimum'=>'100','daily_interest'=>'3.5','interest'=>'60','period'=>'30','category'=>'Peer to Peer']);
        App\Packages::create(['name'=>'Diamond','minimum'=>'500','daily_interest'=>'5.3','interest'=>'160','period'=>'60','category'=>'Peer to Peer']);
        
        App\Packages::create(['name'=>'Pool Silver','minimum'=>'20','daily_interest'=>'4.3','interest'=>'30','period'=>'7','category'=>'Deposit']);
        App\Packages::create(['name'=>'Pool Gold','minimum'=>'100','daily_interest'=>'4.7','interest'=>'66','period'=>'14','category'=>'Deposit']);
        App\Packages::create(['name'=>'Pool Diamond','minimum'=>'500','daily_interest'=>'6.3','interest'=>'190','period'=>'30','category'=>'Deposit']); 
    }
}
