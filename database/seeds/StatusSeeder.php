<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            Status::insert([
                'name' => "NOWE"
            ]);

            Status::insert([
                'name' => "REALIZOWANE"
            ]);

            Status::insert([
                'name' => "WYSŁANE"
            ]);

        }
    }
}
