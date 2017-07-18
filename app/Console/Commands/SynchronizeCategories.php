<?php

namespace App\Console\Commands;

use App\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SynchronizeCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize categories status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = DB::connection('mysql_hurtmet')->select('SELECT * FROM `kategorie`');

        foreach ($data as $record) {
            DB::table('categories')->insert([
                'id' => $record->id,
                'name' => $record->nazwa,
                'parent_id' => $record->nadkat,
                'order' => $record->kolejnosc,
                'photo' => $record->zdjecie,
                'logo' => $record->logotyp,
                'description' => $record->opis,
                'visible' => $record->visible,
                'pair' => $record->para,
                '_lft' => 0,
                '_rgt' => 0
            ]);
        }

        Category::fixTree();
    }
}