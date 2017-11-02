<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id','first_name','last_name', 'email', 'password','street','city','zip_code','company_name', 'number_of_orders', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups(){

        return $this->belongsToMany(Group::class);
    }

    public function roles(){

        return $this->belongsToMany(Role::class, 'user_role');

    }

    public function getGroups(){

        return $this->groups->pluck('name', 'id')->toArray();
    }

    public function getRoles(){
        return $this->roles->pluck('name', 'id')->toArray();
    }


    public function getModules()
    {
        foreach($this->roles as $item) {

            foreach($item->modules as $module){
                if(!isset($roles[$module->id])) {
                    $roles[$module->id] = $module;
                }
            }

        }
        return $roles;
    }

    public function hasAnyRole($roles){

        if(is_array($roles)){
            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }

            }
        }
        else{
            if($this->hasRole($roles)){
                return true;
            }

        }
        return false;
    }

    public function hasRole($role){

        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }

}
