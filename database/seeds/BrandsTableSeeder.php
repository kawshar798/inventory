<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Dolce&Gabbana',
                'slug' => 'dolcegabbana',
                'logo' => 'public/images/brand_logo/dolcegabbana-1599672039.png',
                'status' => 'Active',
                'deleted_at' => NULL,
                'created_at' => '2020-09-09 17:20:39',
                'updated_at' => '2020-09-09 17:20:39',
            ),
        ));
        
        
    }
}