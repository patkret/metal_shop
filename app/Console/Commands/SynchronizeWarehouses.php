<?php

namespace App\Console\Commands;

use App\Warehouse;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SynchronizeWarehouses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize:warehouses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize warehouses status';

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
        $data = DB::connection('mysql_hurtmet')->select('SELECT *, magazyn10.stan AS stan10, magazyn20.stan as stan20 FROM magazyn10 LEFT JOIN magazyn20 ON magazyn20.indeks = magazyn10.indeks');

        foreach ($data as $record) {
        Warehouse::updateOrCreate(['id' => $record->indeks],
            [
                'id' => $record->indeks,
                'code' => $record->kod_tow,
                'name' => $record->nazwa,
                'unit' => $record->jm,
                'wh_price' => $record->cena_hurt,
                'ret_price' => $record->cena_detal,
                'avg_price' => $record->cena_sr_zakupu,
                'stock_10' => $record->stan10,
                'stock_20' => $record->stan20,
                'manual' => $record->odreczna,
                'weight' => $record->waga
            ]);
        }

    }
}
