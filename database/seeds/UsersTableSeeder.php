<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$I7nh5RoA8twLgzg321ftpOmGrXBV6RVEd2kNEPohSVPTJm.YU.HFG',
                'remember_token' => NULL,
                'created_at' => '2020-09-09 17:12:11',
                'updated_at' => '2020-09-09 17:12:11',
            ),
        ));
        
        
    }
}