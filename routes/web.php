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


Route::get('locale/{locale}', [\App\Http\Controllers\HomeController::class, 'changeLocale'])->name('locale');

Route::middleware(['set_locale'])->group(function() {

    Route::group(['middleware' => 'guest'], function(){
        Route::get('register', [\App\Http\Controllers\RegisterController::class, 'create'])->name('register');
        Route::post('register', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register');

        Route::get('login', [\App\Http\Controllers\LoginController::class, 'create'])->name('login');
        Route::post('login', [\App\Http\Controllers\LoginController::class, 'store'])->name('login');
    });

    Route::group(['middleware' => 'auth'], function(){
        Route::get('profile', [\App\Http\Controllers\LoginController::class, 'profile'])->name('profile');
        Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    });


    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{id}', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/changeQuantity', [\App\Http\Controllers\CartController::class, 'changeQuantity'])->name('cart.changeQuantity');
    Route::get('/cart/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
    Route::get('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
    Route::post('/order/create', [\App\Http\Controllers\OrdersController::class, 'createOrder'])->name('order.create');
    Route::post('/order/changeStatus', [\App\Http\Controllers\OrdersController::class, 'changeStatus'])->name('order.changeStatus');
    Route::post('/findCity', [\App\Http\Controllers\OrdersController::class, 'findCity'])->name('findCity');
    Route::post('/getDepartments', [\App\Http\Controllers\OrdersController::class, 'getDepartments'])->name('getDepartments');


    Route::group(['middleware' => 'order'], function() {
        Route::get('/order/complete/{id}', [\App\Http\Controllers\OrdersController::class, 'thankspage'])->name('order.thanks');
    });

    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/collection', '\App\Http\Controllers\CollectionController');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin','namespace' => '\App\Http\Controllers\Admin'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
        Route::resource('categories', 'CategoriesController');
        Route::resource('tags', 'TagsController');
        Route::resource('collections', 'CollectionsController');
        Route::resource('banners', 'BannersController');
        Route::resource('items', 'ItemsController');
        Route::resource('slider', 'SliderController');
        Route::resource('orders', '\App\Http\Controllers\OrdersController');
    });

    Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])->name('about');
    Route::get('/delivery', [\App\Http\Controllers\HomeController::class, 'delivery'])->name('delivery');
    Route::get('/payment', [\App\Http\Controllers\HomeController::class, 'payment'])->name('payment');
    Route::get('/return', [\App\Http\Controllers\HomeController::class, 'return'])->name('return');
    Route::get('/sizes', [\App\Http\Controllers\HomeController::class, 'sizes'])->name('sizes');
    Route::get('/conferent', [\App\Http\Controllers\HomeController::class, 'conferent'])->name('conferent');
    Route::get('/test', [\App\Http\Controllers\HomeController::class, 'test'])->name('test');

});
