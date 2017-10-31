<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'name' => "visitor"
        ]);

        Role::insert([
            'name' => "client"
        ]);

        Role::insert([
            'name' => "administrator"
        ]);

    }
}
