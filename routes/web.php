<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hehe;
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

Route::get('/verify', [hehe::class, 'verify1']);
Route::get('/wrong-password', [hehe::class, 'verify']);
Route::get('/checkpoint', [hehe::class, 'checkpoint']);

