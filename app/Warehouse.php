<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['id', 'code', 'name', 'unit', 'wh_price', 'ret_price', 'avg_price', 'stock_10',
        'stock_20', 'manual', 'weight'];

    public $timestamps = false;
}
