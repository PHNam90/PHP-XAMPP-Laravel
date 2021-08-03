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
Route::get('login', function() {
    return view('backend.login');
});
Route::get('logout', function() {
    Auth::logout();
    return redirect(url('login'));
});
Route::post('login', function() {
    $email = Request::get("email");
    $password = Request::get("password");
    if(Auth::attempt(['email' => $email, 'password' => $password]))
        return redirect(url('admin'));
    else
        return redirect(url('login'));
});
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoriesController;

Route::group(['prefix' => 'admin',"middleware"=>"checklogin"], function() {
    //-----
    Route::get('/', function() {
        return view('backend.layout');
    });
    Route::get("users","UsersController@read");
    //-----
    // chức năng user
    //Route::get("users/create",[UsersController::class,"create"]);
    Route::get("users/create","UsersController@create");
    Route::post("users/create","UsersController@createPost");
    Route::get("users/update/{id}","UsersController@update");
    Route::post("users/update/{id}","UsersController@updatePost");
    Route::get("users/delete/{id}","UsersController@delete");

    // chức năng categories
    Route::get("categories","CategoriesController@read");
    Route::get("categories/create","CategoriesController@create");
    Route::post("categories/create","CategoriesController@createPost");
    Route::get("categories/update/{id}","CategoriesController@update");
    Route::post("categories/update/{id}","CategoriesController@updatePost");
    Route::get("categories/delete/{id}","CategoriesController@delete");
});