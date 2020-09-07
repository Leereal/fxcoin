<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(UsersTableSeeder::class);        
        $this->call(SettingsSeeder::class);   
        $this->call(PackagesSeeder::class); 
        $this->call(PaymentMethodSeeder::class); 
        $this->call(PaymentDetailSeeder::class);  
        $this->call(InvestmentSeeder::class);
        $this->call(MarketPlaceSeeder::class); 
        $this->call(NotificationSeeder::class); 
        $this->call(OnlineUserSeeder::class);         
        $this->call(ReferralBonusSeeder::class);
        $this->call(BonusSeeder::class);  
        $this->call(WithdrawalSeeder::class); 
        $this->call(PendingPaymentSeeder::class);  
        $this->call(StatusesSeeder::class); 
                       
    }
}
