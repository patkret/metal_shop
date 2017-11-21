<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['id', 'category_id'];

    public function product(){

        return $this->belongsTo(Product::class);
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }

}
