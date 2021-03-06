<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use NodeTrait;

    protected $fillable = ['id', 'name', 'parent_id', 'order', 'photo', 'logo', 'description', 'visible', 'pair', '_lft', '_rgt'];

    public $timestamps = false;

    public function groups(){

        return $this->belongsToMany(Group::class);
    }

    public function products(){

        return $this->belongsToMany(Product::class,'product_category','id', 'category_id');
    }

    public static function selectByMain($mainCategory){

        $category = DB::table('maincategory_categories')->where('main_id', $mainCategory)->pluck('category_id');

        return static::whereIn('id', $category)->get();

    }

}
