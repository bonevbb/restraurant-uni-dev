<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','id_parent','category_photo','status'];

    public function menu(){
        return $this->hasMany('App\Menus');
    }
}
