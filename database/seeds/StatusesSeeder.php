<?php

use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Statuses::create(['code'=>'0','name'=>'InActive','description'=>'No longer active or Deleted or Completed']);
        App\Statuses::create(['code'=>'1','name'=>'Active','description'=>'Active and valid']);
        App\Statuses::create(['code'=>'2','name'=>'Pending','description'=>'Pending Both sides']);
        App\Statuses::create(['code'=>'3','name'=>'Cancelled','description'=>'Completely Cancelled']);
        App\Statuses::create(['code'=>'4','name'=>'Blocked','description'=>'Not Allowed']);
        App\Statuses::create(['code'=>'5','name'=>'Temporary Ban','description'=>'Restricted Temporarily']);
        App\Statuses::create(['code'=>'6','name'=>'Permanent Ban','description'=>'Banned forever and no negotiation']);
        App\Statuses::create(['code'=>'100','name'=>'Removed','description'=>'Deleted or Removed by one side waiting for complete removal']);
        App\Statuses::create(['code'=>'101','name'=>'Partially Activate','description'=>'Banned forever and no negotiation']);
        App\Statuses::create(['code'=>'102','name'=>'Partially Pending','description'=>'Begin Pending process waiting for other side to activate pending']);
        App\Statuses::create(['code'=>'103','name'=>'Partially Cancelled','description'=>'Cancel process waiting for other side to approve activate cancel']);
        
    }
}
