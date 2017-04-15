<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Categories;
use App\Menus;
use Illuminate\Support\Facades\Session;

class KitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menus::all();

        return view('admin.menus',['menus' => $menus]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('menus.create' , ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            ['menu_name' => 'required',
                'menu_price'=> 'required|min:0',
                'id_category' => 'required',
                'menu_qty' => 'min:0'
                ],
            [//0 => 'Полето име е задължително',
                ]);
        //add
        $data = $request->all();

        $menu = new Menus();
        $menu->menu_name = $data['menu_name'];
        $menu->menu_description = $data['menu_description'];
        $menu->menu_price = $data['menu_price'];
        $menu->id_menu_category = $data['id_category'];
        $menu->stock_qty =  $data['menu_qty'];

        if(isset($data['enable_menu'])){
            $menu->menu_status = 1;
        }
        else{
            $menu->menu_status = 0;
        }
        $menu->save();
        return redirect()->to('admin/menus')->with('success', 'Записа е добавен успешно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
