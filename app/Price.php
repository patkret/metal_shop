<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['product_id', 'price_basis', 'factor', 'show_missing'];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
