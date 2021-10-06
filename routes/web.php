<?php

use App\Http\Livewire\Category\Create as CreateCategory;
use App\Http\Livewire\Product\Create as CreateProduct;
use App\Http\Livewire\User\Index as UserIndex;
use App\Http\Livewire\Shop\Show as ShowShop;
use App\Http\Livewire\Shop\View;
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

Route::get('/', UserIndex::class)->middleware('auth');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('shop', function(){
    return view('shop.index');
})->middleware('auth');

Route::middleware('auth')->group(function(){

    Route::get('create_category/{shop_id}', CreateCategory::class);
    Route::get('create_product/{shop_id}', CreateProduct::class);
    Route::get('show_shop/{shop}', ShowShop::class);

});

Route::get('shop/{name}', View::class); 
