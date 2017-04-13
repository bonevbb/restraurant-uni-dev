<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function getNavbar()
    {
        return view('tutorial.navbar');
    }

    public function getView1()
    {
        return view('tutorial.view1');
    }

    public function getView2()
    {
        return view('tutorial.view2');
    }

    public function getView3()
    {
        return view('tutorial.view3');
    }
}
