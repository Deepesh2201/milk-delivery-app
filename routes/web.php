<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Masters\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'salesman', 'middleware' => ['auth', 'SalesmanControl']], function () {
    Route::get('offloading', 'Common\Loading\OffloadingController@index')->name('user.offloading.index');
    Route::get('offloading/data', 'Common\Loading\OffloadingController@search')->name('user.offloading.search');
    Route::get('onloading/data', 'Common\Loading\OnloadingController@search')->name('user.onloading.search');
    Route::get('onloading/create', 'Common\Loading\OnloadingController@create')->name('user.onloading.create');
    Route::post('onloading/store', 'Common\Loading\OnloadingController@store')->name('user.onloading.store');
    Route::get('onloading/edit/{id}', 'Common\Loading\OnloadingController@edit')->name('user.onloading.edit');
    Route::get('onloading/startonloading/{id}', 'Common\Loading\OnloadingController@startonloading')->name('user.onloading.startonloading');
    Route::get('onloading', 'Common\Loading\OnloadingController@index')->name('user.onloading.index');
    Route::get('startonload/{id}','Common\Loading\OnloadingController@startonload')->name('user.onloading.startonload');
    Route::post('onloading/driverdetails', 'Common\Loading\OnloadingController@driverdetails')->name('user.onloading.driverdetails');

    // Route::get('onloading-approve/{id}', 'Admin\Loading\OnloadingController@approve')->name('onloading.approve');

    // Route::resource('onloading',  'Admin\Loading\OnloadingController');


    //Sale
    Route::get('sale/data', 'Common\Shop\SaleController@search')->name('sale.search');
    Route::get('sale-delete/{id}', 'Common\Shop\SaleController@delete')->name('sale.delete');
    Route::resource('sale',  'Common\Shop\SaleController');

    //Return
    Route::get('return-product/data', 'Common\Shop\ReturnProductController@search')->name('return.product.search');
    Route::get('return-product-delete/{id}', 'Common\Shop\ReturnProductController@delete')->name('return.product.delete');
    Route::resource('return-product',  'Common\Shop\ReturnProductController');
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'AdminControl']], function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('product/data', 'Admin\Masters\ProductController@search')->name('product.search');
    Route::get('product-delete/{id}', 'Admin\Masters\ProductController@delete')->name('product.delete');
    Route::resource('product',  'Admin\Masters\ProductController');

    Route::get('salesman/data', 'Admin\Masters\SalesmanController@search')->name('salesman.search');
    Route::get('salesman-delete/{id}', 'Admin\Masters\SalesmanController@delete')->name('salesman.delete');
    Route::resource('salesman',  'Admin\Masters\SalesmanController');

    Route::get('customer/data', 'Admin\Masters\CustomerController@search')->name('customer.search');
    Route::get('customer-delete/{id}', 'Admin\Masters\CustomerController@delete')->name('customer.delete');
    Route::resource('customer',  'Admin\Masters\CustomerController');
    //Loading
    Route::get('onloading/data', 'Admin\Loading\OnloadingController@search')->name('onloading.search');
    Route::get('onloading-delete/{id}', 'Admin\Loading\OnloadingController@delete')->name('onloading.delete');
    Route::get('onloading-approve/{id}', 'Admin\Loading\OnloadingController@approve')->name('onloading.approve');
    Route::resource('onloading',  'Admin\Loading\OnloadingController');

    //OffLoading
    Route::get('offloading/data', 'Admin\Loading\OffloadingController@search')->name('offloading.search');
    Route::get('offloading-delete/{id}', 'Admin\Loading\OffloadingController@delete')->name('offloading.delete');
    Route::resource('offloading',  'Admin\Loading\OffloadingController');

    // //Sale
    //     Route::get('sale/data', 'Common\Shop\SaleController@search')->name('sale.search');
    //     Route::get('sale-delete/{id}', 'Common\Shop\SaleController@delete')->name('sale.delete');
    //     Route::resource('sale',  'Common\Shop\SaleController');

    //Return
    // Route::get('return-product/data', 'Common\Shop\ReturnProductController@search')->name('return.product.search');
    // Route::get('return-product-delete/{id}', 'Common\Shop\ReturnProductController@delete')->name('return.product.delete');
    // Route::resource('return-product',  'Common\Shop\ReturnProductController');

    // Route::resource('product',  ProductController::class);
    // Route::get('product/data', [ProductController::class, 'search'])->name('product.search');
    // Route::post('product-delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Route::resource('product', 'Masters\ProductController');
    // Route::get('/dashboard',[HomeController::class,'showDashboard'])->name('dashboard');

});
Route::middleware('auth')->group(function () {
    Route::get('admin/salesreport', 'ReportController@index')->name('salesreport.index');
    Route::get('admin/salesreport/searched-sales-results', 'ReportController@search')->name('search');

    Route::get('admin/salesreturnreport', 'ReportController@salesreturnlist')->name('salesreturnreport.salesreturnlist');
    Route::get('admin/searched-sales-return-results', 'ReportController@salesreturnsearchsearch')->name('salesreturnsearchsearch');

    Route::get('admin/salestargetreport', 'ReportController@salestargetlist')->name('salestargetreport.salestargetlist');
    Route::get('admin/salesreport/searched-target-sales-results', 'ReportController@salestargetsearch')->name('salestargetsearch');

    Route::get('admin/onloadingreport', 'ReportController@onloadinglist')->name('onloadingreport.onloadinglist');
    Route::get('admin/salesreport/searched-onloading-results', 'ReportController@onloadingsearch')->name('onloadingsearch');

    Route::get('admin/offloadingreport', 'ReportController@offloadinglist')->name('offloadingreport.offloadinglist');
    Route::get('admin/salesreport/searched-offloading-results', 'ReportController@offloadingsearch')->name('offloadingsearch');
});

Route::middleware('auth')->group(function () {
    Route::resource('user',  ProfileController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/sk', function () {
    \Artisan::call('config:cache');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
});
require __DIR__ . '/auth.php';
