<?php

namespace App\Console\Commands;

use App\Set;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SynchronizeSets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize:sets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $data = DB::connection('mysql_hurtmet')->select('SELECT * FROM `zestawy`');

        $tempSets = [];
        foreach ($data as $record) {
            $set = Set::create([
                'name' => $record->nazwa,
                'price' => $record->suma,
                'description' => $record->opis,
                'photo' => $record->zdjecie,
                'visible' => $record->visible
            ]);
            $tempSets[$record->id] = $set->id;
        }

        $setProducts = DB::connection('mysql_hurtmet')->select('SELECT * FROM `produkt_zest`');
        foreach ($setProducts as $row) {
            DB::table('set_has_products')->insert([
                'id' => $tempSets[$row->id],
                'product_id' => DB::table('products')->where('old_id', $row->indeks)->value('id'),
                'amount' => $row->ilosc
            ]);
        }

    }
}
