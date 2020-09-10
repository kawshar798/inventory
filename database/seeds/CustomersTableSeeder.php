<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Jamal Ahmed',
                'email' => 'jamal@gmai.com',
                'phone' => '01879000000',
                'address' => 'Dhaka',
                'city' => NULL,
                'type' => NULL,
                'photo' => NULL,
                'shop' => NULL,
                'account_holder' => NULL,
                'account_number' => NULL,
                'bank_name' => NULL,
                'branch_name' => NULL,
                'created_at' => '2020-09-10 03:37:05',
                'updated_at' => '2020-09-10 03:37:05',
            ),
        ));
        
        
    }
}