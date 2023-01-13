<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\ProductMapIntegrationController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\SaleController;
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
    return view('welcome');
});

Route::resource('clients', ClientController::class);
Route::resource('providers', ProvidersController::class);
Route::resource('product_integrations', ProductMapIntegrationController::class);
Route::resource('products', ProdutosController::class);
Route::resource('sales', SaleController::class);
Route::get('/cart/{pid}', [SaleController::class, 'getCart'])->name('getCart');
Route::get('product_integrations/integrate/{id}', [ProductMapIntegrationController::class,'integrate'])->name('integrate');


Route::view('/vendas', 'pages.vendas')->name('vendas');
Route::view('/fornecedores', 'pages.fornecedores')->name('fornecedores');
Route::view('/produtos', 'pages.produtos')->name('produtos');
Route::view('/login', 'auth.login')->name('login');