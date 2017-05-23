<?php

namespace App\Http\Controllers\Admin;

use App\MenuOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Categories;
use App\Menus;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Options;

class KitchenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menus::with('category')->orderBy('id', 'desc')->paginate(15);
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
            [
                'menu_name' => 'required',
                'menu_price'=> 'required|min:0',
                'id_category' => 'required',
                'menu_qty' => 'min:0'
                ],
            [
               'menu_name.required' => 'Въвеждането на име е задължително!',
               'menu_price.required' => 'Въвеждането на цена е задължително',
               'menu_price.min' => 'Моля въведете положително число',
               'id_category.required'=> 'Избора на категория е задължителен',
               'menu_qty.min' => 'Въвеждането на количество е задължително',
            ]
        );
        //add
        $data = $request->all();

        $image = $request->file('image_menu');

        if ($image != null) {
            $extension = $image->getClientOriginalExtension(); // getting image extension

            $fileName = md5(time()) . '.' . $extension; // renameing image

            $destinationPath = 'img/menus';
            $image->move($destinationPath, $fileName);
        }

        $menu = new Menus();
        $menu->menu_name = $data['menu_name'];
        $menu->menu_description = $data['menu_description'];
        $menu->menu_price = $data['menu_price'];
        $menu->category_id = $data['id_category'];
        $menu->stock_qty =  $data['menu_qty'];

        if ($image != null) {
            $menu->menu_photo = 'img/menus/' . $fileName;
        } else {
            $menu->menu_photo = 'img/no-image.png';
        }

        if(isset($data['enable_menu'])){
            $menu->menu_status = 1;
        }
        else{
            $menu->menu_status = 0;
        }
        $menu->save();

        $menuOptions = explode(',',$data['menu_options']);

        foreach ($menuOptions as $menuOption) {
            if(empty($menuOption)){
                continue;
            }
            $option_id = Options::getOptionByName(trim($menuOption));

            $newMenuOption = new MenuOptions();
            $newMenuOption->menu_id = $menu->id;
            $newMenuOption->option_id = $option_id;

            $newMenuOption->save();

        }


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
        $options = [];
        //Load edit view
        $menus = Menus::find($id);
        $categories = Categories::all();

        if(isset($menus->id)){
            $menuOptions  = MenuOptions::getOptionsByMenuId($menus->id);
        }
        else{
            return;
        }


        foreach ($menuOptions as $menuOption) {
            $options[] = Options::getOptionById($menuOption->option_id);
        }

        return view('menus.edit',['menus' => $menus,'categories' => $categories, 'options' => implode(', ',$options)]);
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
                'menu_price'=> 'required|min:0',
                'id_category' => 'required',
                'menu_qty' => 'min:0'
            ],
            [
                'menu_name.required' => 'Въвеждането на име е задължително!',
                'menu_price.required' => 'Въвеждането на цена е задължително',
                'menu_price.min' => 'Моля въведете положително число',
                'id_category.required'=> 'Избора на категория е задължителен',
                'menu_qty.min' => 'Въвеждането на количество е задължително',
            ]);

        $data = $request->all();

        $image = $request->file('image_menu');

        if ($image != null) {
            $extension = $image->getClientOriginalExtension(); // getting image extension

            $fileName = md5(time()) . '.' . $extension; // renameing image

            $destinationPath = 'img/menus';
            $image->move($destinationPath, $fileName);
        }

        $menu = Menus::find($id);
        $menu->menu_name = $data['menu_name'];
        $menu->menu_description = $data['menu_description'];
        $menu->menu_price = $data['menu_price'];
        $menu->category_id = $data['id_category'];
        $menu->stock_qty =  $data['menu_qty'];

        if ($image != null) {
            $menu->menu_photo = 'img/menus/' . $fileName;
        }

        if(isset($data['enable_menu'])){
            $menu->menu_status = 1;
        }
        else{
            $menu->menu_status = 0;
        }

        $menu->save();

        $menuOptions = explode(',',$data['menu_options']);

        $deleteOptions = MenuOptions::getOptionsByMenuId($menu->id);

        foreach ($deleteOptions as $deleteOption) {
            $deleleOptNow = MenuOptions::find($deleteOption->id);
            $deleleOptNow->delete();
        }

        foreach ($menuOptions as $menuOption) {
            if(empty($menuOption)){
                continue;
            }

            $option_id = Options::getOptionByName(trim($menuOption));

            $newMenuOption = new MenuOptions();
            $newMenuOption->menu_id = $menu->id;
            $newMenuOption->option_id = $option_id;

            $newMenuOption->save();
        }

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

        if($menu->menu_photo != null) {
            \File::Delete($menu->menu_photo);
        }

        $menu->delete();

        // redirect
        return redirect()->to('admin/menus')->with('success', 'Записа е изтрит!');
    }
}
