<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name("dashboard");

Route::get('/agent.create', function () {
    return view('add_agent');
})->name('agent.create');

Route::get('/site.create', function () {
    return view('add_site_area');
})->name('site.create');

Route::get('/profile', function () {
    return view('profile');
})->name("profile");


Route::get('/forms', function () {
    return view('forms');
})->name("forms");

Route::get('/subscribe', function () {
    return view('subscribe');
})->name("subscribe");

Auth::routes();