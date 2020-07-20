<?php

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PaymentMethod::create(['name'=>'ABSA']);
        App\PaymentMethod::create(['name'=>'FNB']);
        App\PaymentMethod::create(['name'=>'BITCOIN']);
        App\PaymentMethod::create(['name'=>'ECOCASH']);
        App\PaymentMethod::create(['name'=>'PERFECT MONEY']);
        App\PaymentMethod::create(['name'=>'SKRILL']);
    }
}
