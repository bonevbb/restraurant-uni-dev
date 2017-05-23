<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Options;

class AutoCompleteController extends Controller
{
    public function optionsAutoComplete(){
        $options = Options::all()->toArray();
        return response()->json($options);
    }
    public function optionsAutoCompleteEdit(){
        $options = Options::all()->toArray();
        return response()->json($options);
    }
}
