<?php

use Illuminate\Database\Seeder;

class ReferralBonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ReferralBonus::class, 20)->create();
    }
}
