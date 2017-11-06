<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(GroupsSeeder::class);
         $this->call(RolesSeeder::class);
         $this->call(ModulesSeeder::class);
         $this->call(StatusSeeder::class);

    }
}
