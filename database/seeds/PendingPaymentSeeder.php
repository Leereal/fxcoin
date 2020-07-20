<?php

use Illuminate\Database\Seeder;

class PendingPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PendingPayment::class, 20)->create();
    }
}
