<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id', 'old_id', 'code', 'name', 'unit', 'weight', 'desc_short', 'desc_long', 'visible', 'photo_1', 'photo_2', 'stock_10', 'stock_20', 'stock_30', 'show_missing', 'wh_price', 'ret_price', 'price_basis', 'avg_buy_price', 'custom_margin', 'value_discount', 'vd_target', 'amount_discount', 'ad_target', 'amount_discount_2', 'ad_target_2'
    ];

    public $timestamps = false;

    public function groups(){

        return $this->belongsToMany(Group::class);
    }

    public function productsGroups(){

        return $this->groups->pluck('name', 'id')->toArray();
    }

    public function category(){

        return $this->belongsToMany(Category::class);
    }
}
