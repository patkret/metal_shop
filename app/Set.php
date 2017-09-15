<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = ['name', 'price', 'photo', 'description', 'visible'];

    public $timestamps = false;
}
