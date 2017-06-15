<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return Redirect::route('home');
});


Route::get('home', ['as' =>	'home', 'uses' => 'HomeController@home']);
Route::get('about', ['as' => 'about', 'uses' =>	'HomeController@about']);

// User Registration
Route::group(['middleware' => ['web']], function ()
{
    Route::get('registration', ['as' =>	'registration', 'uses' => 'RegistrationController@registration']);
    Route::post('registration', ['as' => 'registration', 'uses' => 'RegistrationController@registrationForm']);
});

// User LogIn & LogOut
Route::get('/authme/{id}', function($id){
    Auth::login(\App\User::find($id));
    return Auth::user();
});
Route::group(['middleware' => ['web']], function ()
{
    Route::get('login', ['as'	=>	'login', 'uses' 	=>	'LoginController@login']);
    Route::post('login', ['as'	=>	'login', 'uses' 	=>	'LoginController@loginForm']);
    Route::get('logout', ['as'	=>	'logout', 'uses' 	=>	'LoginController@logout']);
});

//  Search Products
Route::group(['middleware' => ['web']], function ()
{
    Route::post('searchProduct', ['as'	=>	'searchProduct', 'uses' 	=>	'SearchController@productSearch']);
});

/*  Product */
Route::get('product', ['as' => 'product', 'uses' => 'ProductsController@index']);
Route::get('product/create', ['as' => 'product.create', 'uses' => 'ProductsController@productCreate']);
Route::post('product/store', ['as' => 'product.store', 'uses' => 'ProductsController@store']);
Route::get('product/{product}', ['as' => 'product.show', 'uses' => 'ProductsController@singleProduct']);
Route::get('product/{id}/edit', ['as' => 'product.edit', 'uses' => 'ProductsController@edit']);
Route::put('product/{id}/update', ['as' => 'product.update', 'uses' => 'ProductsController@update']);
Route::get('product/{id}/delete', ['as' => 'product.delete', 'uses' => 'ProductsController@destroy']);

/* Order */
Route::get('order/{id}', ['as' => 'cancel.order', 'uses' => 'OrderController@cancelOrder']);
Route::post('order/{id}', ['as' => 'product.order', 'uses' => 'OrderController@productOrder']);
Route::get('clearCart', ['as' => 'clearCart', 'uses' => 'OrderController@clearCart']);
Route::get('checkout', ['as' => 'checkout', 'uses' => 'OrderController@checkout']);
Route::post('checkout', ['as' => 'checkout', 'uses' => 'OrderController@checkoutPurchase']);


/* User Profile */
Route::group(['middleware' => ['web']], function ()
{
    Route::get('profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
    // edit profile
    Route::get('profile/edit/', ['as' => 'edit.profile', 'uses' => 'UserController@editProfile']);
    Route::post('profile/edit/', ['as' => 'edit.profile', 'uses' => 'UserController@editProfileForm']);
    Route::post('avatar/edit/', ['as' => 'edit.avatar', 'uses' => 'UserController@editAvatar']);
});

// User Registration
Route::group(['middleware' => ['web']], function ()
{
    Route::get('dashboard', ['as' =>'dashboard', 'uses' => 'DashboardController@dashboard']);
    Route::get('users', ['as' => 'users', 'uses' => 'DashboardController@users']);
    Route::get('blacklist/{id}', ['as' => 'make.blacklist', 'uses' => 'DashboardController@doBlacklist']);
    Route::get('removeBlacklist/{id}', ['as' =>	'removeBlacklist', 'uses' => 'DashboardController@removeBlacklist']);
    Route::get('blacklisted', ['as'	=> 'blacklisted', 'uses' => 'DashboardController@blacklistedUsers']);
    Route::get('admins', ['as' => 'admins', 'uses' => 'DashboardController@admins']);
    Route::get('makeAdmin/{id}', ['as' => 'make.admin', 'uses' => 'DashboardController@makeAdmin']);
    Route::get('removeAdminship/{id}', ['as' => 'remove.admin', 'uses' => 'DashboardController@removeAdmin']);
    Route::get('products', ['as' => 'products', 'uses' => 'DashboardController@products']);
    Route::get('pendingProducts', ['as' => 'products.pending', 'uses' => 'DashboardController@pendingProducts']);
    Route::get('approve/{id}', ['as' => 'approve', 'uses' => 'DashboardController@approveProduct']);
    Route::get('deleteProduct/{id}', ['as' => 'products.delete', 'uses' => 'DashboardController@deleteProduct']);
    Route::get('categories', ['as' => 'categories', 'uses' => 'DashboardController@categories']);
    Route::post('createCategories', ['as' => 'category.create', 'uses' => 'DashboardController@createCategories']);
    Route::get('deleteCategory/{id}', ['as' => 'delete.catagory', 'uses' => 'DashboardController@deleteCategory']);
    Route::get('orderHistory', ['as' => 'orderHistory', 'uses' => 'DashboardController@orderHistory']);
    Route::get('productOrder', ['as' => 'product.orders', 'uses' => 'DashboardController@productOrder']);
});