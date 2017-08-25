<?php

namespace App\Console\Commands;

use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class SynchronizeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize products status';

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

        $products = DB::connection('mysql_hurtmet')->select('SELECT *, magazyn10.stan AS stan10, magazyn20.stan as stan20 FROM magazyn10 LEFT JOIN magazyn20 ON magazyn20.indeks = magazyn10.indeks ORDER BY magazyn10.indeks ASC');

        $tempVisible = [];
        $productVisible = DB::connection('mysql_hurtmet')->select('SELECT * FROM wyswietlane');
        foreach ($productVisible as $product) {
            array_push($tempVisible, $product->indeks);
        }

        $tempCategories = [];

        foreach ($products as $record) {
            $product = Product::create([
                'old_id' => $record->indeks,
                'code' => $record->kod_tow,
                'name' => $record->nazwa,
                'unit' => $record->jm,
                'wh_price' => $record->cena_hurt,
                'ret_price' => $record->cena_detal,
                'avg_price' => $record->cena_sr_zakupu,
                'stock_10' => $record->stan10,
                'stock_20' => $record->stan20,
                'manual' => $record->odreczna,
                'weight' => $record->waga,
                'visible' => in_array($record->indeks,$tempVisible) ? 1 : 0
            ]);

            $tempCategories[$record->indeks] = $product->id;

        }

        $productCategories = DB::connection('mysql_hurtmet')->select('SELECT * FROM produkt_kat ORDER BY produkt_kat.indeks ASC');

        foreach ($productCategories as $record) {

            DB::table('product_has_categories')->insert([
                    'id' => $tempCategories[$record->indeks],
                    'category_id' => $record->id_kat
                ]
            );
        }

        // error with index, no product has index 0
        // DELETE FROM `produkt_kat` WHERE `indeks` = 0

    }
}
