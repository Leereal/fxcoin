<?php

use Illuminate\Database\Seeder;

class MarketPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MarketPlace::class, 30)->create();
    }
}
