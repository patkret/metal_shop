<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['old_id', 'code', 'name', 'unit', 'wh_price', 'ret_price', 'avg_price', 'stock_10',
        'stock_20', 'manual', 'weight', 'visible'];

    public $timestamps = false;

    public function price()
    {

        return $this->hasOne('App\Price');

    }
}
