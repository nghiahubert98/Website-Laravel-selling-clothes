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

Route::get('PageAdmin', function () {
   return view('admin.master');
});

Route::get('index', ['as'=>'home-page','uses'=>'PageController@getIndex']);

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function() {
	Route::group(['prefix'=>'cate'],function() {
		Route::get('list',['as'=>'admin.cate.list','uses'=>'CateController@getList']);
		Route::get('add',['as'=>'admin.cate.getAdd','uses'=>'CateController@getAdd']);
		Route::post('add',['as'=>'admin.cate.postAdd','uses'=>'CateController@postAdd']);
		Route::get('delete/{id}',['as'=>'admin.cate.getDelete','uses'=>'CateController@getDelete']);
		Route::get('edit/{id}',['as'=>'admin.cate.getEdit','uses'=>'CateController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.cate.postEdit','uses'=>'CateController@postEdit']);
	});
	Route::group(['prefix'=>'product'],function() {
		Route::get('list',['as'=>'admin.product.list','uses'=>'ProductController@getList']);
		Route::get('add',['as'=>'admin.product.getAdd','uses'=>'ProductController@getAdd']);
		Route::post('add',['as'=>'admin.product.postAdd','uses'=>'ProductController@postAdd']);
		Route::get('delete/{id}',['as'=>'admin.product.getDelete','uses'=>'ProductController@getDelete']);
		Route::get('edit/{id}',['as'=>'admin.product.getEdit','uses'=>'ProductController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.product.postEdit','uses'=>'ProductController@postEdit']);
		Route::get('delimg/{id}',['as'=>'admin.product.getDelImg','uses'=>'ProductController@getDelImg']);
		Route::get('delsize/{id}',['as'=>'admin.product.getDelSize','uses'=>'ProductController@getDelSize']);
	});
	Route::group(['prefix'=>'user'],function() {
		Route::get('list',['as'=>'admin.user.list','uses'=>'UserController@getList']);
		Route::get('add',['as'=>'admin.user.getAdd','uses'=>'UserController@getAdd']);
		Route::post('add',['as'=>'admin.user.postAdd','uses'=>'UserController@postAdd']);
		Route::get('delete/{id}',['as'=>'admin.user.getDelete','uses'=>'UserController@getDelete']);
		Route::get('edit/{id}',['as'=>'admin.user.getEdit','uses'=>'UserController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.user.postEdit','uses'=>'UserController@postEdit']);
	});
	Route::group(['prefix'=>'bill'],function() {
		Route::get('list',['as'=>'admin.bill.list','uses'=>'BillController@getList']);
		Route::get('delete/{id}',['as'=>'admin.bill.getDelete','uses'=>'BillController@getDelete']);
		Route::get('edit/{id}',['as'=>'admin.bill.getEdit','uses'=>'BillController@getEdit']);
		Route::post('edit/{id}',['as'=>'admin.bill.postEdit','uses'=>'BillController@postEdit']);
	});
	Route::group(['prefix'=>'contact'],function() {
		Route::get('list',['as'=>'admin.contact.list','uses'=>'ContactController@getList']);
		Route::get('delete/{id}',['as'=>'admin.contact.getDelete','uses'=>'ContactController@getDelete']);
	});
	Route::group(['prefix'=>'statistics'],function() {
		Route::get('list',['as'=>'admin.statistics.getList','uses'=>'StatisticsController@getList']);
		Route::get('edit/{id}',['as'=>'admin.statistics.getEdit','uses'=>'StatisticsController@getEdit']);
	});
});

Route::get('product-cate/{id}/{alias}',['as'=>'productcate','uses'=>'PageController@productcate']);
Route::get('product-cate-parent/{id}/{alias}',['as'=>'productcateparent','uses'=>'PageController@productcateparent']);
Route::get('product-cate-grandparent/{id}/{alias}',['as'=>'productcategrandparent','uses'=>'PageController@productcategrandparent']);


Route::get('product-detail/{id}/{alias}',['as'=>'productdetail','uses'=>'PageController@productdetail']);

Route::get('myaccount',['as'=>'myaccount','uses'=>'PageController@myAccount']);
Route::get('order-history',['as'=>'orderhistory','uses'=>'PageController@orderhistory']);

Route::get('edit-account',['as'=>'editaccount','uses'=>'PageController@getEditAccount']);
Route::post('edit-account',['as'=>'editaccount','uses'=>'PageController@postEditAccount']);

Route::get('add-to-cart/{id}/{alias}',['as'=>'addtocart','uses'=>'PageController@addtocart']);
Route::post('cart',['as'=>'cart','uses'=>'PageController@cart']);
Route::get('cart-info',['as'=>'cartinfo','uses'=>'PageController@cartinfo']);
Route::get('detete-cart/{id}',['as'=>'detetecart','uses'=>'PageController@detetecart']);
Route::get('update-cart/{id}/{qty}',['as'=>'updatecart','uses'=>'PageController@updatecart']);
Route::get('check-out',['as'=>'checkout','uses'=>'PageController@checkout']);
Route::post('checkout',['as'=>'postcheckout','uses'=>'PageController@postCheckout']);
Route::get('contact',['as'=>'contact','uses'=>'PageController@getContact']);
Route::post('contact',['as'=>'contact','uses'=>'PageController@postContact']);
Route::get('search',['as'=>'search','uses'=>'PageController@postSearch']);
Route::get('billdetail/{id}',['as'=>'billdetail','uses'=>'PageController@getBillDetail']);


Route::get('login',['as'=>'login','uses'=>'Auth\LoginController@getLogin']);
Route::post('login',['as'=>'login','uses'=>'Auth\LoginController@postLogin']);
Route::post('login-checkout',['as'=>'logincheckout','uses'=>'Auth\LoginController@postLogincheckout']);
Route::get('logout', 'Auth\LoginController@logout');
Route::get('register', 'Auth\RegisterController@getRegister');
Route::post('register', 'Auth\RegisterController@postRegister');

Route::get('pay-with-paypal',['as'=>'payment.paypal','uses'=>'PageController@payWithPaypal']);
Route::get('paypal-success',['as'=>'payment.paypalSuccess','uses'=>'PageController@paypalSuccess']);
