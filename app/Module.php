<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Module extends Model
{
    protected $fillable = ['id', 'name'];

    public $timestamps = false;

    public function roles(){

        return $this->belongsToMany(Role::class, 'role_module');
    }
}
