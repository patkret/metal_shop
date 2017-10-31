<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;



class SynchronizeUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes users';

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
        $old_users = DB::connection('mysql_hurtmet')->select('SELECT * FROM `users`');

        foreach ($old_users as $record) {
            DB::table('users')->insert([
                'id' => $record->id,
                'email' => $record->mail->unique(),
                'first_name' => $record->imie,
                'last_name' => $record->nazwisko,
                'password' => $record->haslo,
                'company_name' => $record->firma,
                'street' => $record->ulica,
                'city' => $record->miasto,
                'zip_code' => $record->kod,
                'phone_no' => $record->tel_kom,
                'nip' => $record->nip,
                'created_at' => $record->data_rej

            ]);
        }
    }
}
