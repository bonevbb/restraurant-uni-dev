<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::orderBy('id', 'desc')->paginate(15);
        return view('admin.categories',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,
            [
                'category_name' => 'required',
            ],
            [
                0 => 'Въвеждането на име е задължително!',
            ]);
        //add
        $data = $request->all();

        $image = $request->file('image_category');

        if ($image != null) {
            $extension = $image->getClientOriginalExtension(); // getting image extension

            $fileName = md5(time()) . '.' . $extension; // renameing image

            $destinationPath = 'img/categories';
            $image->move($destinationPath, $fileName);
        }

        $category = new Categories();
        $category->name = $data['category_name'];

        if(isset($data['menu_description'])){
            $category->description = $data['category_description'];
        }
        else{
            $category->description = '';
        }

        if ($image != null) {
            $category->category_photo = 'img/categories/' . $fileName;
        }

        if(isset($data['enable_category'])){
            $category->status = 1;
        }
        else{
            $category->status = 0;
        }
        $category->save();
        return redirect()->to('admin/categories')->with('success', 'Категорията е добавена успешно!');
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
        //Load edit view
        $category = Categories::find($id);

        return view('categories.edit',['category' => $category]);
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
                'category_name' => 'required',
            ],
            [
                0 => 'Въвеждането на име е задължително!',
            ]);

        $data = $request->all();

        $image = $request->file('image_category');

        if ($image != null) {
            $extension = $image->getClientOriginalExtension(); // getting image extension

            $fileName = md5(time()) . '.' . $extension; // renameing image

            $destinationPath = 'img/categories';
            $image->move($destinationPath, $fileName);
        }

        $category = Categories::find($id);
        $category->name = $data['category_name'];
        $category->description = $data['category_description'];

        if ($image != null) {
            $category->category_photo = 'img/categories/' . $fileName;
        }

        if(isset($data['enable_category'])){
            $category->status = 1;
        }
        else{
            $category->status = 0;
        }

        $category->save();

        return redirect()->to('admin/categories')->with('success', 'Категорията е променена успешно!');
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
        $category = Categories::find($id);
        $name_cat = $category->name;

        try {
            $category->delete();
        }catch(\Exception $e){
            return redirect()->to('admin/categories')->with('fail', 'Към категорията "' . $name_cat .'" има добавени продукти! Моля първо изтрийте или преместете продуктите!');
        }

        // redirect
        return redirect()->to('admin/categories')->with('success', 'Категорията "' . $name_cat .'" е изтрита!');
    }
}
