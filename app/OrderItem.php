<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['quantity'];

    public function order(){

        return $this->belongsTo(Order::class);
    }
}
