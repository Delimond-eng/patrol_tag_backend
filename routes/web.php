<?php

use App\Http\Controllers\AdminController;
use App\Models\Site;
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
    $sites = Site::where("status", "actif")->get();
    return view('add_agent',[
        "sites"=>$sites
    ]);
})->name('agent.create');

Route::get('/agents.list', function () {
    return view('agent_list');
})->name('agents.list');

Route::get('/sites.list', function () {
    return view('site_list');
})->name('sites.list');

Route::get('/site.create', function () {
    return view('add_site_area');
})->name('site.create');

Route::post("site.create", [AdminController::class, "createAgencieSite"])->name("site.create");
Route::post("agent.create", [AdminController::class, "createAgent"])->name("agent.create");



Auth::routes();