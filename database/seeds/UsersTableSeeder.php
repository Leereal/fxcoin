<?php

use Illuminate\Database\Seeder;
Use App\Country;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */    
    public function run()
    {  
        //Seeding Roles
        $admin = App\Role::create(['name'=>'Admin']);
        $member = App\Role::create(['name'=>'Member']);
        $support = App\Role::create(['name'=>'Support']);     

        // //Seeding Branches
        // $zim = Country::create([
        // 	'name'=>'Zimbabwe'      	
        // ]);
        // $sa = Country::create([
        // 	'name'=>'South Africa'      	
        // ]);
        // $usa = Country::create([
        // 	'name'=>'United States'      	
        // ]);
        // $uk = Country::create([
        // 	'name'=>'United Kingdom'      	
        // ]);
        //Seeding Users
        $lee =App\User::create([
            'name'=>'Liberty',
            'surname'=>'Mutabvuri',
            'email'=>'leereal08@gmail.com',
            'email_verified_at' => now(),
            'password'=>bcrypt('mutabvuri$8'),
            'cellphone'=>'+27651749011',
            'username'=>'Leereal',            
            'ipAddress'=>'192.12.15.41.65',
            'country_id'=>'239',
            'currency_id'=>'1',             
        ]);
        $jael =App\User::create([
            'name'=>'Jael',
            'surname'=>'Mutabvuri',
            'email'=>'jaeljayleen@gmail.com',
            'email_verified_at' => now(),
            'password'=>bcrypt('mutabvuri$8'),
            'cellphone'=>'+27651749012',
            'username'=>'Jael', 
            'referrer_id'=>'1',
            'ipAddress'=>'192.12.15.41.64',
            'country_id'=>'239', 
            'currency_id'=>'1',               
        ]);
        $nyasha =App\User::create([
            'name'=>'Nyasha',
            'surname'=>'Mutabvuri',
            'email'=>'nyasha@gmail.com',
            'email_verified_at' => now(),
            'password'=>bcrypt('mutabvuri$8'),
            'cellphone'=>'+27651749013',           
            'username'=>'Nyasha',
            'referrer_id'=>'1', 
            'ipAddress'=>'192.12.15.41.63',
            'country_id'=>'239',  
            'currency_id'=>'2',            
        ]);

        //Attaching Roles to user
        $lee->roles()->attach($admin);
        $jael->roles()->attach($member);
        $nyasha->roles()->attach($support);       
        
        factory(App\User::class, 100)->create();
    }
}
