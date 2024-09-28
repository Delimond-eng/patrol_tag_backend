<?php

namespace App\Http\Controllers;

use App\Models\Agencie;
use App\Models\Agent;
use App\Models\Area;
use App\Models\Schedules;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * CREATE AGENCY
     * @param Request $request
     * @return JsonResponse
     */
    public function createAgencie(Request $request)
    {
        try{
            $data = $request->validate([
                "name"=>"required|string|unique:agencies,name",
                "adresse"=>"required|string",
                "logo"=>"nullable|file",
                "phone"=>"nullable|string",
                "email"=>"nullable|string",
            ]);
            $response = Agencie::create($data);
            return response()->json([
                "status"=>"success",
                "response"=>$response
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors ]);
        }
        catch (\Illuminate\Database\QueryException $e){
            return response()->json(['errors' => $e->getMessage() ]);
        }
    }


    /**
     * Add or Create Site for Agency and areas
     * @param Request $request
     * @return JsonResponse
     */
    public function createAgencieSite(Request $request)
    {
        try{
            $data = $request->validate([
                "name"=>"required|string",
                "code"=>"required|string|unique:code",
                "latlng"=>"required|string",
                "adresse"=>"required|string",
                "phone"=>"nullable|string",
                "agency_id"=>"required|int|exists:agencies,id",
                "areas.*.libelle"=>"required|string",
                "areas.*.latlng"=>"required|string",
                "areas.*.qrcode"=>"required|string",
            ]);
            $response = Site::updateOrCreate(
                [
                    "code"=>$data["code"],
                    "agency_id"=>$data["agency_id"],
                ],
                $data
            );
            if($response){
                //Crée les zones de patrouille pour un site nouvellement créé
                $areas = $data["areas"];
                foreach ($areas as $area) {
                    $area['site_id'] = $response->id;
                    Area::updateOrCreate(
                        [
                            "site_id"=>$area["site_id"],
                            "libelle"=>$area["libelle"]
                        ],
                        $area
                    );
                }
            }
            return response()->json([
                "status"=>"success",
                "response"=>$response
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors ]);
        }
        catch (\Illuminate\Database\QueryException $e){
            return response()->json(['errors' => $e->getMessage() ]);
        }
    }

    /**
     * View all agents by agency
     * @return JsonResponse
    */
    public function viewAllSites(){
        $user = Auth::user();
        $datas = Site::with('agencie')
            ->where('status', 'actif')
            ->where('agency_id', $user->agency_id)
            ->orderByDesc('id')
            ->get();
        return response()->json([
            "status"=>"success",
            "sites"=>$datas
        ]);
    }



    /**
     * CREATE OR ASSIGN AGENT
     * @param Request $request
     * @return JsonResponse
    */
    public function createAgent(Request $request){
        try{
            $data = $request->validate([
                "matricule"=>"required|string|unique:agents,matricule",
                "fullname"=>"required|string",
                "password"=>"required|string",
                "agency_id"=>"required|int|exists:agencies,id",
                "site_id"=>"required|int|exists:sites,id"
            ]);
            $response = Agent::updateOrCreate(
                [
                    "agency_id"=>$data["agency_id"],
                    "matricule"=>$data["matricule"],
                ],
                $data
            );
            return response()->json([
                "status"=>"success",
                "response"=>$response
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors ]);
        }
        catch (\Illuminate\Database\QueryException $e){
            return response()->json(['errors' => $e->getMessage() ]);
        }
    }


    /**
     * View all agents by agency
     * @return JsonResponse
    */
    public function viewAllAgents(){
        $user = Auth::user();
        $datas = Agent::with('agencie')->with('site')
            ->where('status', 'actif')
            ->where('agency_id', $user->agency_id)
            ->orderByDesc('id')
            ->get();
        return response()->json([
            "status"=>"success",
            "agents"=>$datas
        ]);
    }


    /**
     * CREATE SCANNING SCHEDULES
     * @param Request $request
     * @return JsonResponse
    */
    public function createScanningSchedule(Request $request){
        try{
            $data = $request->validate([
                "libelle"=>"required|string",
                "start_time"=>"required|string",
                "end_time"=>"nullable|string",
                "site_id"=>"required|int|exists:sites,id"
            ]);
            $response = Schedules::updateOrCreate(
                [
                    "libelle"=>$data["libelle"],
                    "site_id"=>$data["site_id"],
                ],
                $data
            );
            return response()->json([
                "status"=>"success",
                "response"=>$response
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors ]);
        }
        catch (\Illuminate\Database\QueryException $e){
            return response()->json(['errors' => $e->getMessage() ]);
        }
    }


    /**
     * VIEW ALL SCHEDULES
     * @return JsonResponse
    */
    public function viewAllScanSchedules(){
        $user = Auth::user();
        $datas = Schedules::with('site')
                    ->where("status", "actif")
                    ->where("agency_id", $user->agency_id)
                    ->orderByDesc('id')
                    ->get();
        return response()->json([
            "status" => "success",
            "schedules"=> $datas
        ]);
    }


}