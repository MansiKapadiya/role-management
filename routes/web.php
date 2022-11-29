<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index')->name('index');
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/order/{id}', [App\Http\Controllers\HomeController::class, 'addToCart'])->name('addToCart');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Admin\RoleController', ['names' => 'admin.roles']);
    Route::resource('admins', 'Admin\AdminController', ['names' => 'admin.admins']);
    Route::resource('categories', 'Admin\CategoryController', ['names' => 'admin.categories']);
    Route::resource('products', 'Admin\ProductController', ['names' => 'admin.products']);
    Route::resource('stock', 'Admin\StockController', ['names' => 'admin.stock']);
    Route::get('orders', 'Admin\OrderController@index')->name('admin.orders.index');

    // Login Routes
    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Admin\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Admin\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Admin\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Admin\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});