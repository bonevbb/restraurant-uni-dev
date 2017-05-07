<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Categories;
use App\Menus;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
        $pagination = DB::table('menus')->paginate(15);


        return view('admin.menus',['menus' => $menus,'pagination'=>$pagination]);
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
            [
                0 => 'Въвеждането на име е задължително!',
                1 => 'Въвеждането на цена е задължително',
                2 => 'Избора на категория е задължително',
                3 => 'Въвеждането на количество е задължително',
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
        //Load edit view
        $menus = Menus::find($id);
        $categories = Categories::all();
        return view('menus.edit',['menus' => $menus,'categories' => $categories]);
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
        $this->validate($request,
            [
                'menu_name' => 'required',
//                'menu_price'=> 'required|min:0',
//                'id_category' => 'required',
//                'menu_qty' => 'min:0'
            ],
            [
//                0 => 'Въвеждането на име е задължително!',
//                1 => 'Въвеждането на цена е задължително',
//                2 => 'Избора на категория е задължително',
//                3 => 'Въвеждането на количество е задължително',
            ]);

        $data = $request->all();

        $menu = Menus::find($id);
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

        return redirect()->to('admin/menus')->with('success', 'Записа е променен успешно!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $menu = Menus::find($id);
        $menu->delete();

        // redirect
        return redirect()->to('admin/menus')->with('success', 'Записа е изтрит!');
    }
}
