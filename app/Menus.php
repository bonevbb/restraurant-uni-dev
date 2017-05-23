<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['menu_name','menu_description','menu_price','menu_photo','category_id','stock_qty','menu_status'];

    public function category(){
        return $this->hasOne('App\Categories','id' , 'category_id');
    }
}
