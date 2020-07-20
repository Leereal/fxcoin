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
        App\Packages::create(['name'=>'Silver','minimum'=>'10','daily_interest'=>'2.5','interest'=>'17.5','period'=>'7']);
        App\Packages::create(['name'=>'Gold','minimum'=>'100','daily_interest'=>'3.5','interest'=>'105','period'=>'30']);
        App\Packages::create(['name'=>'Diamond','minimum'=>'500','daily_interest'=>'5','interest'=>'300','period'=>'60']);       
    }
}
