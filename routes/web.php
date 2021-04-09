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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('companies', App\Http\Controllers\CompanyController::class);
Route::resource('groups', App\Http\Controllers\GroupController::class);

// currency routes
Route::get('/currencies_list', [App\Http\Controllers\CurrencyController::class, 'currency'])->name('currencies');


// user profile
Route::get('/profile/{id}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::resource('currencies', App\Http\Controllers\CurrencyController::class);
Route::get('/currency_list_json', [App\Http\Controllers\CurrencyController::class, 'currency_list'])->name('currency_list_json');


// exchange
Route::get('/exchanges/screen1', [App\Http\Controllers\ExchangeController::class, 'screen1'])->name('screen1');
Route::get('/exchanges/exchange_list', [App\Http\Controllers\ExchangeController::class, 'exchange_list']);
Route::resource('exchanges', App\Http\Controllers\ExchangeController::class);
