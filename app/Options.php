<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Options extends Model
{
    //
    protected $table = 'options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','status'];

    public static function getOptionByName($name){
        $option_id = DB::table('options')->where('name', $name)->value('id');
        return $option_id;
    }

    public static function getOptionById($id){
        $option_id = DB::table('options')->where('id', $id)->value('name');
        return $option_id;
    }
}
