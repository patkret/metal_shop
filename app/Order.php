<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'status_id', 'user_id'];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function status(){

        return $this->belongsTo(Status::class);
    }

    public function order_item(){

        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
