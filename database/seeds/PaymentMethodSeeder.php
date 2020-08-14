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
        App\PaymentMethod::create(['name'=>'BITCOIN','avatar'=>'bitcoin.png']);
        App\PaymentMethod::create(['name'=>'SKRILL','avatar'=>'skrill.png']);
        App\PaymentMethod::create(['name'=>'PERFECT MONEY','avatar'=>'perfect_money.png']);
        App\PaymentMethod::create(['name'=>'NETELLER','avatar'=>'neteller.png']);
    }
}
