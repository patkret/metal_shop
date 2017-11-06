<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['id', 'name'];

    public function orders(){

        return $this->belongsToMany(Order::class);

    }
}