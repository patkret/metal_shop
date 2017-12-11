<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maincategory_categories')->insert([
            //steel fasteners
            [
                'main_id' =>'1',
                'category_id' => '1',
            ],
            [
                'main_id' =>'1',
                'category_id' => '2',
            ],
            [
                'main_id' =>'1',
                'category_id' => '3',
            ],
            [
                'main_id' =>'1',
                'category_id' => '4',
            ],
            [
                'main_id' =>'1',
                'category_id' => '5',
            ],
            [
                'main_id' =>'1',
                'category_id' => '6',
            ],
            [
                'main_id' =>'1',
                'category_id' => '7',
            ],
            [
                'main_id' =>'1',
                'category_id' => '8',
            ],
            [
                'main_id' =>'1',
                'category_id' => '9',
            ],
            //sailing accessories
            [
                'main_id' =>'2',
                'category_id' => '11',
            ],
            [
                'main_id' =>'2',
                'category_id' => '12',
            ],
            [
                'main_id' =>'2',
                'category_id' => '10',
            ],
            //tools
            [
                'main_id' =>'3',
                'category_id' => '13',
            ],
            [
                'main_id' =>'3',
                'category_id' => '14',
            ],
            [
                'main_id' =>'3',
                'category_id' => '16',
            ],
            [
                'main_id' =>'3',
                'category_id' => '483',
            ],
            //chemicals
            [
                'main_id' =>'4',
                'category_id' => '15',
            ],
            [
                'main_id' =>'4',
                'category_id' => '311',
            ],
            [
                'main_id' =>'4',
                'category_id' => '540',
            ],

        ]);
    }
}
