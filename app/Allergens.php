<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergens extends Model
{
    //
    protected $table = 'allergens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','status'];
}
