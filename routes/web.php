<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppManagerController;
use App\Models\Agent;
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

Auth::routes();
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name("dashboard");

Route::get('/agent.create', function () {
    $agencyId = Auth::user()->agency_id;
    $sites = Site::where("status", "actif")->where("agency_id", $agencyId)->get();
    return view('add_agent',[
        "sites"=>$sites
    ]);
})->name('agent.create');

Route::get('/agents.list', function () {
    $agencyId = Auth::user()->agency_id;
    $sites = Site::where("status", "actif")->where("agency_id", $agencyId)->get();
    return view('agent_list', [
        "sites"=>$sites
    ]);
})->name('agents.list');

Route::get('/sites.list', function () {
    return view('site_list',);
})->name('sites.list');

Route::get("/sites", function () {
    $agencyId = Auth::user()->agency_id;
    $sites = Site::where("status", "actif")
        ->where("agency_id", $agencyId)
        ->with([
            "areas" => function ($query) {
                return $query->where("status", "actif");
        }])
        ->get();
    return response()->json([
        "sites" => $sites
    ]);
});
Route::get("/agents", function () {
    $agencyId = Auth::user()->agency_id;
    $agents = Agent::where("status", "actif")
        ->where("agency_id", $agencyId)
        ->with([
            "site" => function ($query) {
                return $query->where("status", "actif");
        }])
        ->get();
    return response()->json([
        "agents" => $agents
    ]);
});

Route::get('/site.create', function () {
    return view('add_site_area');
})->name('site.create');

Route::view("/reports", "reports");
Route::view("/announces", "announces");


Route::get("/announces.all", function (){
    $agencyId = Auth::user()->agency_id;
    $announces = \App\Models\Announce::with("site")
        ->where("status", "actif")
        ->where("agency_id", $agencyId)
        ->get();
    return response()->json([
        "status"=>"success",
        "announces"=>$announces
    ]);
});

Route::post("site.create", [AdminController::class, "createAgencieSite"])->name("site.create");
Route::post("agent.create", [AdminController::class, "createAgent"])->name("agent.create");
Route::post("announce.create", [AppManagerController::class, "createAnnounce"])->name("announce.create");
Route::post("delete", [AppManagerController::class, "triggerDelete"])->name("delete");
Route::get("/loadpdf/{siteId}", [AppManagerController::class, "generatePdfWithQRCodes"])->name("loadpdf");
Route::get("/patrols.pending", [AppManagerController::class, "viewPendingPatrols"])->name("patrols.pending");
Route::get("/patrols.reports", [AppManagerController::class, "viewPatrolReports"])->name("patrols.reports");
