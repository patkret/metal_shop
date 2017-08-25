<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SynchronizePrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize:prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize prices';

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
        $data = DB::connection('mysql_hurtmet')->select('SELECT * FROM `ceny`');
        $data2 = DB::table('products')->get();

        $productIDs = [];

        foreach ($data2 as $product) {
            $productIDs[$product->old_id] = $product->id;
        }

        foreach ($data as $record) {
            DB::table('prices')->insert([
                'product_id' => $productIDs[$record->indeks],
                'price_basis' => $record->cena_baza = 'hurt' ? 'wh_price' : 'ret_price',
                'factor' => $record->procent,
                'show_missing' => $record->wys_brak
            ]);
        }

    }
}
