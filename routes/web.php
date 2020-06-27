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

Route::get('/', 'Controller@Index');

Route::get('/repository', 'Controller@Repository');

Route::get('/add', 'Controller@Addbook');

Route::post('book/Add', ['uses'=>'BookController@Store'])->name('storeBook');

Route::get('repository/search', ['uses'=>'Controller@Search'])->name('search');