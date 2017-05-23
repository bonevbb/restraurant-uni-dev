<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('tutorial', 'TutorialController@getNavbar');
//Route::get('/home1', 'TutorialController@getView1');
//Route::get('/about-us', 'TutorialController@getView2');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [
        'uses' => 'Admin\AdminController@getLogin',
        'as'    => 'admin.login'
    ]);

    Route::post('/', [
        'uses' => 'Admin\AdminController@postLogin',
        'as'    => 'admin.login'
    ]);

    Route::get('/dashboard', [
        'uses' => 'Admin\AdminController@getDashboard',
        'middleware' => 'admin.auth',
        'as'    => 'dashboard'
    ]);

    Route::get('/logout', [
        'uses' => 'Admin\AdminController@getLogout',
        'as'    => 'admin.logout'
    ]);

    Route::get('/menus/product-options', 'Admin\AutoCompleteController@optionsAutoComplete');
    Route::get('/menus/{id}/product-options', 'Admin\AutoCompleteController@optionsAutoCompleteEdit');

    Route::resource('/menus','Admin\KitchenController');
    Route::resource('/categories','Admin\CategoriesController');
    Route::resource('/options','Admin\OptionsController');
    Route::resource('/allergens','Admin\AllergensController');
});



Auth::routes();

Route::get('/home', 'HomeController@index');
