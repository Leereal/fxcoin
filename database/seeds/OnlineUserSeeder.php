<?php

use Illuminate\Database\Seeder;

class OnlineUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\OnlineUser::class, 100)->create();
    }
}
