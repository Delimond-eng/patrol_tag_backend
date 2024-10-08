<?php

use App\Http\Controllers\AppManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post("/agency.create", [\App\Http\Controllers\AdminController::class, "createAgencie"])->name("agency.create");
Route::post("area.complete", [\App\Http\Controllers\AdminController::class, "completeArea"])->name("area.complete");
Route::post("patrol.scan", [AppManagerController::class, "startPatrol"])->name("patrol.scan");
Route::post("patrol.close", [AppManagerController::class, "closePatrolTag"])->name("patrol.close");
Route::get("/patrols.pending", [AppManagerController::class, "viewPendingPatrols"])->name("patrols.pending");
Route::get("/announces.load", [AppManagerController::class, "loadAnnouncesFromMobile"])->name("announces.load");
Route::post("/agent.login", [AppManagerController::class, "loginAgent"])->name("agent.login");

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
