<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Group extends Model
{

    protected $fillable = ['id', 'name', 'discount'];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function products(){

        return $this->belongsToMany(Product::class);
    }
}
