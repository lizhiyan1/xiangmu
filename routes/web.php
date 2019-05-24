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

Route::get('/', function () {
	session(['uid'=>88]);
    return view('welcome',['name'=>'李治严']);
});
//Route::view('/','welcome',['name'=>'李治严']);
//路由URL请求
Route::get('/goods','GoodsController@index');
Route::get('/admin','AdminController@index');

// Route::any('index/{id}/{name}',function($id,$name){
//     echo $id;
//     echo $name;
// })->where(['id'=>'[0-9]+','name'=>'[a-z]{6,}']);

// Route::get('/from', function () {
// 	return "<form action='/sendemail' method=post>".csrf_field()."<input type=text name=email><button>提交</button></form>";
// });
Route::get('/from', function () {
	return "<form action='/logindo' method=post>".csrf_field()."<input type=text name=email> <input type=password name=password > <button>提交</button></form>";
});
// Route::any('/sendemail',function(){
//    return request()->name;
// });
// Route::post('sendemail','BrandController@sendemail');
Route::post('/logindo','BrandController@logindo');

// Route::get('/index/{id?}',function($id=0){
// return redirect('/index');
// })->where('id','\d+');
// 商品品牌 curd
//->middleware(['checklogin'])
Route::prefix('/brand')->group(function(){
	Route::get('add','BrandController@create');
	Route::post('add_do','BrandController@store');
	Route::post('add_do2','BrandController@add_do2');
	Route::get('list','BrandController@index');
	Route::get('show/{id}','BrandController@show');
	Route::get('edit/{id}','BrandController@edit');
	Route::post('update/{id}','BrandController@update');
	Route::post('del/{id}','BrandController@destroy');
});

Route::prefix('/admin')->group(function(){
	Route::get('index','AdminController@index');
	Route::get('main','AdminController@main');
	Route::get('head','AdminController@head');
	Route::get('left','AdminController@left');
	
});


Route::prefix('/news')->group(function(){
	Route::get('add','NewsController@create');
	Route::post('add_do','NewsController@store');
	Route::get('list','NewsController@index');
	Route::get('edit/{id}','NewsController@edit');
	Route::get('del/{id}','NewsController@destroy');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
