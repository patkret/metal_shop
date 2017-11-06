<?php

use Illuminate\Database\Seeder;
use App\Module;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::insert([
            'path' => "categories",
            'name' => "kategorie"
        ]);

        Module::insert([
            'path' => "groups",
            'name' => "grupy"
        ]);

        Module::insert([
            'path' => "products",
            'name' => "produkty"
        ]);

        Module::insert([
            'path' => "sets",
            'name' => "zestawy"
        ]);

        Module::insert([
            'path' => "users",
            'name' => "użytkownicy"
        ]);

        Module::insert([
            'path' => "roles",
            'name' => "role"
        ]);

        Module::insert([
            'path' => "status",
            'name' => "statusy zamówień"
        ]);
    }
}
