<?php

use Illuminate\Database\Seeder;
use App\Group as Group;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::insert([
            'name' => "BEZ RABATU",
            'discount' => 0
        ]);

        Group::insert([
            'name' => "5% RABAT",
            'discount' => 5
        ]);

        Group::insert([
            'name' => "10% RABAT",
            'discount' => 10
        ]);


    }
}
