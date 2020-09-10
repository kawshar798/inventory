<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Women',
                'slug' => 'women',
                'description' => NULL,
                'parent_id' => 0,
                'featured' => 1,
                'image' => NULL,
                'status' => 'Active',
                'deleted_at' => NULL,
                'created_at' => '2020-09-09 17:13:36',
                'updated_at' => '2020-09-09 17:13:36',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Men',
                'slug' => 'men',
                'description' => NULL,
                'parent_id' => 0,
                'featured' => 0,
                'image' => NULL,
                'status' => 'Active',
                'deleted_at' => NULL,
                'created_at' => '2020-09-09 17:14:12',
                'updated_at' => '2020-09-09 17:14:12',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Handbags',
                'slug' => 'handbags',
                'description' => NULL,
                'parent_id' => 1,
                'featured' => 0,
                'image' => NULL,
                'status' => 'Active',
                'deleted_at' => NULL,
                'created_at' => '2020-09-09 17:14:40',
                'updated_at' => '2020-09-10 03:16:44',
            ),
        ));
        
        
    }
}