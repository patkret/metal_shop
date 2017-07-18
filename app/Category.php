<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $fillable = ['id', 'name', 'parent_id', 'order', 'photo', 'logo', 'description', 'visible', 'pair', '_lft', '_rgt'];

    public $timestamps = false;
}
