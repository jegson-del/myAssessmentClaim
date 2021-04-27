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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/search', 'App\Http\Controllers\SearchClaimController@search')->name('claim.user.search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'web'], function(){
    Route::get('/claims', 'App\Http\Controllers\HomeController@show')->name('show.user.claims');
    Route::get('/claim/{event}', 'App\\Http\Controllers\HomeController@event')->name('show.claim.event');
    Route::post('/upload/form', 'App\Http\Controllers\HomeController@store')->name('store.user.claim');
    Route::get('/success', 'App\Http\Controllers\HomeController@success')->name('show-success');
});
