<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'pc',
                'slug' => 'pc',
                'status' => 'Active',
                'deleted_at' => NULL,
                'created_at' => '2020-09-10 03:24:52',
                'updated_at' => '2020-09-10 03:27:13',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'm',
                'slug' => 'm',
                'status' => 'Active',
                'deleted_at' => NULL,
                'created_at' => '2020-09-10 03:25:25',
                'updated_at' => '2020-09-10 03:26:56',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Kg',
                'slug' => 'kg',
                'status' => 'Active',
                'deleted_at' => NULL,
                'created_at' => '2020-09-10 03:26:02',
                'updated_at' => '2020-09-10 03:26:02',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'gm',
                'slug' => 'gm',
                'status' => 'Active',
                'deleted_at' => NULL,
                'created_at' => '2020-09-10 03:26:15',
                'updated_at' => '2020-09-10 03:27:23',
            ),
        ));
        
        
    }
}