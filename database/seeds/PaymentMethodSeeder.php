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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Truncate the table.
        DB::table('payment_methods')->truncate();
        App\PaymentMethod::create(['name'=>'BITCOIN','avatar'=>'bitcoin.png','currency_id'=>'1']);
        App\PaymentMethod::create(['name'=>'SKRILL','avatar'=>'skrill.png','currency_id'=>'1']);
        App\PaymentMethod::create(['name'=>'NETELLER','avatar'=>'neteller.png','currency_id'=>'1']);
        App\PaymentMethod::create(['name'=>'PERFECT MONEY','avatar'=>'perfect_money.png','currency_id'=>'1']);
        App\PaymentMethod::create(['name'=>'FNB (SOUTH AFRICA)','avatar'=>'fnb.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'STANDARD BANK (SOUTH AFRICA)','avatar'=>'standard_bank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'NEDBANK (SOUTH AFRICA)','avatar'=>'nedbank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'CAPITEC (SOUTH AFRICA)','avatar'=>'capitec.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'ABSA (SOUTH AFRICA)','avatar'=>'absa.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'AFRICAN BANK  (SOUTH AFRICA)','avatar'=>'africa_bank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'BIDVEST (SOUTH AFRICA)','avatar'=>'bidvest.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'DISCOVERY (SOUTH AFRICA)','avatar'=>'discovery.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'GRINDROD (SOUTH AFRICA)','avatar'=>'grindrod.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'GROBANK (SOUTH AFRICA)','avatar'=>'grobank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'IMPERIAL (SOUTH AFRICA)','avatar'=>'imperial.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'SASFIN (SOUTH AFRICA)','avatar'=>'sasfin.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'TYMEBANK (SOUTH AFRICA)','avatar'=>'tymebank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'ABSA (BOTSWANA)','avatar'=>'absa.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'BANCABC (BOTSWANA)','avatar'=>'bancabc.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'FIRST CAPITAL (BOTSWANA)','avatar'=>'first_capital.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'FNB (BOTSWANA)','avatar'=>'fnb.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'STANBIC (BOTSWANA)','avatar'=>'stanbic.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'STANDARD (BOTSWANA)','avatar'=>'standard_bank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'NEDBANK (NAMIBIA)','avatar'=>'nedbank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'STANDARD (NAMIBIA)','avatar'=>'standard_bank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'TRUSTCO (NAMIBIA)','avatar'=>'trustco.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'ATLANTICO (NAMIBIA)','avatar'=>'atlantico.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'BANK BIC (NAMIBIA)','avatar'=>'bankbic.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'LETSHEGO (NAMIBIA)','avatar'=>'letshego.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'NEDBANK (SWAZILAND)','avatar'=>'nedbank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'STANDARD (SWAZILAND)','avatar'=>'standard_bank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'FNB (SWAZILAND)','avatar'=>'fnb.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'STANDARD (LESOTHO)','avatar'=>'standard_bank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'NEDBANK (LESOTHO)','avatar'=>'nedbank.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'FNB (LESOTHO)','avatar'=>'fnb.png','currency_id'=>'2']);
        App\PaymentMethod::create(['name'=>'MPESA (LESOTHO)','avatar'=>'mpesa.png','currency_id'=>'2']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
