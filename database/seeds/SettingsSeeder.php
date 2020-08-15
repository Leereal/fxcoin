<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Settings::create(['user_type'=>'All','market_place_status'=>'1','min_deposit'=>'10','max_deposit'=>'10000','min_withdrawal'=>'10','max_withdrawal'=>'10','max_transactions'=>'5','number_of_users'=>'50','total_deposits'=>'5000','total_withdrawals'=>'7000','total_online'=>'50','trade_type'=>'BOTH','currency_id'=>'1','bitcoim'=>'gspnfywlkznajd63nq528ebsvjatevhav']);     
    }
}
