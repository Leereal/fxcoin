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
        App\PaymentMethod::create(['name'=>'BITCOIN','avatar'=>'bitcoin.png','currency_id'=>'1']);
        App\PaymentMethod::create(['name'=>'SKRILL','avatar'=>'skrill.png','currency_id'=>'1']);
        App\PaymentMethod::create(['name'=>'NETELLER','avatar'=>'neteller.png','currency_id'=>'1']);
        App\PaymentMethod::create(['name'=>'PERFECT MONEY','avatar'=>'perfect_money.png','currency_id'=>'1']);
        App\PaymentMethod::create(['name'=>'FNB (SOUTH AFRICA)','avatar'=>'fnb.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'STANDARD BANK (SOUNT AFRICA)','avatar'=>'standard_bank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'NEDBANK (SOUTH AFRICA)','avatar'=>'nedbank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'CAPITEC (SOUTH AFRICA)','avatar'=>'capitec.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'ABSA (SOUTH AFRICA)','avatar'=>'absa.png','currency_id'=>'2']);
    }
}
