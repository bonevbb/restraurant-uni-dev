<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuOptions extends Model
{
    protected $table = 'menu_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['menu_id','option_id'];

    public function menu(){
        return $this->hasMany('App\Menus','id','menu_id');
    }
    public function option(){
        return $this->hasMany('App\Options','id','option_id');
    }

    public static function getOptionsByMenuId($menu_id){
        $options = DB::table('menu_options')->where('menu_id', $menu_id)->get();
        return $options;
    }
}
