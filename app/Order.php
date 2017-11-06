<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'status'];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function status(){

        return $this->belongsTo(Status::class);
    }
}
