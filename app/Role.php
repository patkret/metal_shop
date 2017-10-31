<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['id', 'name'];

    public $timestamps = false;

    public function users(){

        return $this->belongsToMany(User::class, 'user_role');
    }

    public function modules(){

        return $this->belongsToMany(Module::class, 'role_module');
    }
    public function rolesModules(){
        return $this->modules->pluck('name', 'id')->toArray();
    }
}
