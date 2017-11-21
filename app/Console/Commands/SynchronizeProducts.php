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

        $products = DB::connection('mysql_hurtmet')->select('SELECT magazyn10.*, magazyn20.stan as stan20, magazyn30.stan as stan30,
            (case when (wyswietlane.indeks = magazyn10.indeks) THEN 1 ELSE 0 END) AS `wyswietlane`,
            opis_prod.opis, opis_prod.zdjecie, opis_prod.opis2, opis_prod.zdjecie2,
            IFNULL(ceny.cena_baza, "detal") as cena_baza,
            IFNULL(ceny.wys_brak, 0) as wys_brak,
            (case when (promocje.indeks = magazyn10.indeks) THEN promocje.procent ELSE null END) AS `marza_promocyjna`
            FROM magazyn10 
            LEFT JOIN magazyn20 ON magazyn20.indeks = magazyn10.indeks 
            LEFT JOIN magazyn30 ON magazyn30.indeks = magazyn10.indeks 
            LEFT JOIN wyswietlane ON wyswietlane.indeks = magazyn10.indeks
            LEFT JOIN opis_prod ON opis_prod.indeks = magazyn10.indeks
            LEFT JOIN ceny ON ceny.indeks = magazyn10.indeks
            LEFT JOIN promocje ON promocje.indeks = magazyn10.indeks
            ORDER BY magazyn10.indeks ASC');

        $tempCategories = []; // named array mapping old and new ID's to sync product_has_categories

        foreach ($products as $record) {
            $product = Product::create([
                'old_id' => $record->indeks,
                'code' => $record->kod_tow,
                'name' => $record->nazwa,
                'unit' => $record->jm,
                'weight' => $record->waga,
                'desc_short' => $record->opis,
                'desc_long' => $record->opis2,
                'visible' => $record->wyswietlane,
                'photo_1' => $record->zdjecie,
                'photo_2' => $record->zdjecie2,
                'stock_10' => $record->stan,
                'stock_20' => $record->stan20,
                'stock_30' => $record->stan30,
                'show_missing' => $record->wys_brak,
                'wh_price' => $record->cena_hurt,
                'ret_price' => $record->cena_detal,
                'price_basis' => $record->cena_baza === 'detal' ? 'ret_price' : 'wh_price',
                'avg_buy_price' => $record->cena_sr_zakupu,
                'custom_margin' => $record->marza_promocyjna,
                'value_discount' => 0,
                'vd_target' => 0,
                'amount_discount' => 0,
                'ad_target' => 0,
                'amount_discount_2' => 0,
                'ad_target_2' => 0
            ]);

            $tempCategories[$record->indeks] = $product->id;

        }

        $productCategories = DB::connection('mysql_hurtmet')->select('SELECT * FROM produkt_kat ORDER BY produkt_kat.indeks ASC');

        foreach ($productCategories as $record) {
            DB::table('product_category')->insert([
                    'id' => $tempCategories[$record->indeks],
                    'category_id' => $record->id_kat
                ]
            );
        }

        // error with index, no product has index 0
        // DELETE FROM `produkt_kat` WHERE `indeks` = 0

    }
}
