<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Patrol;
use App\Models\PatrolScan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppManagerController extends Controller
{
    /**
     * Start patrol tag
     * @param Request $request
     * @return JsonResponse
     */
    public function startPatrol(Request $request) : JsonResponse
    {
        try {
            $data = $request->validate([
                "patrol_id" => "nullable|int|exists:patrols,id",
                "site_id"   => "required_if:patrol_id,null|int|exists:sites,id",
                "agency_id" => "required_if:patrol_id,null|int|exists:agencies,id",
                "scan.agent_id" => "required|int|exists:agents,id",   // Correction pour la validation des champs imbriqués
                "scan.area_id"  => "required|int|exists:areas,id",    // Correction pour la validation des champs imbriqués
                "scan.comment"  => "nullable|string",
                "scan.latlng"   => "required|string"                  // Correction pour la validation des champs imbriqués
            ]);

            $scan = $data["scan"];
            $area = Area::find($scan['area_id']);

            // Extraction des coordonnées GPS de la zone et du scan
            list($areaLat, $areaLng) = explode(':', $area->latlng ?? "8844757:30934949");
            list($scanLat, $scanLng) = explode(':', $scan['latlng']);

            // Calcul de la distance en mètres entre les deux points GPS
            $distance = $this->calculateDistance($areaLat, $areaLng, $scanLat, $scanLng);
            $tolerance = 1; // Tolérance de distance en mètres

            // Mise à jour du statut du scan en fonction de la distance
            $scan['status'] = ($distance <= $tolerance) ? "success" : "fail";
            $scan['distance'] = "{$distance} m";

            // Si la patrouille existe, on ajoute le scan
            if (!empty($data['patrol_id'])) {
                $scan["patrol_id"] = $data["patrol_id"];
                $response = PatrolScan::create($scan);

                return response()->json([
                    "status" => "success",
                    "result" => $response
                ]);
            }

            // Sinon, on démarre une nouvelle patrouille
            $now = Carbon::now();
            $data["started_at"] = $now->toDateTimeString();
            $data["status"] = "pending";
            $data["agent_id"] = $scan["agent_id"];

            $patrol = Patrol::create($data);

            if ($patrol) {
                $scan["patrol_id"] = $patrol->id;
                PatrolScan::create($scan);

                return response()->json([
                    "status" => "success",
                    "result" => $patrol
                ]);
            }
        } 
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()->all()], 400);
        }
        catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }

        return response()->json([
            "errors" => "Echec de traitement de la requête !"
        ], 500);
    }



    /**
     * View all pending Patrol
     * @return JsonResponse
    */
    public function viewPendingPatrols(){
        $agencyId = Auth::user()->agency_id;
        $patrols = Patrol::with("site.areas")
            ->with("agent")
            ->with("scans.agent")
            ->with("scans.area")
            ->where("status", "pending")
            ->where("agency_id", $agencyId)
            ->get();
        return response()->json([
            "status"=>"success",
            "pending_patrols"=>$patrols
        ]);
    }


    /**
     * Close Patrol Tag
     * @param Request $request
     * @return JsonResponse
     */
    public function closePatrolTag(Request $request) : JsonResponse
    {
        try {
            // Validation des données
            $data = $request->validate([
                "site_id" => "required|int|exists:sites,id",
                "agent_id" => "required|int|exists:agents,id",
                "agency_id" => "required|int|exists:agencies,id",
                "patrol_id" => "required|int|exists:patrols,id",
                "comment_text" => "nullable|string",
                "comment_audio" => "nullable|file|mimes:audio/mpeg,mpga,mp3,wav",
                "scans.*.latlng" => "required|string",
                "scans.*.comment" => "nullable|string",
                "scans.*.agent_id" => "nullable|int|exists:agents,id",
                "scans.*.patrol_id" => "required|int|exists:patrols,id",
                "scans.*.area_id" => "required|int|exists:areas,id",
            ]);

            // Gestion du fichier audio s'il est présent
            if ($request->hasFile('comment_audio')) {
                $audioFile = $request->file('comment_audio');
                $agencyId = $data['agency_id'];
                $audioPath = "uploads/agencie_{$agencyId}/audio";
                $filename = "audio_" . time() . '.' . $audioFile->getClientOriginalExtension();
                $filePath = $audioFile->storeAs($audioPath, $filename, 'public');
                $data['comment_audio'] = url("storage/{$filePath}");
            }

            // Ajout des informations de fin de patrouille
            $now = Carbon::now();
            $data["ended_at"] = $now->toDateTimeString();
            $data["status"] = "terminate";

            $patrol = Patrol::find($data["patrol_id"]);
            if ($patrol) {
                $patrol->update($data);
                // Traitement des scans et calcul de la distance
                $scans = $data["scans"];
                foreach ($scans as $scan) {
                    $area = Area::find($scan['area_id']);
                    // Extraction des coordonnées GPS de la zone et du scan
                    list($areaLat, $areaLng) = explode(':', $area->latlng);
                    list($scanLat, $scanLng) = explode(':', $scan['latlng']);
                    // Calcul de la distance en mètres entre les deux points GPS
                    $distance = $this->calculateDistance($areaLat, $areaLng, $scanLat, $scanLng);
                    // Mise à jour du statut du scan en fonction de la distance (1 mètre de tolérance)
                    if ($distance <= 1) {
                        $scan['status'] = "success";
                        $scan['distance'] = "{$distance} m";
                    } else {
                        $scan['status'] = "fail";
                        $scan['distance'] = "{$distance} m";
                    }
                    //Sauvegarde des données du scan patrouille
                    PatrolScan::create($scan);
                }
                return response()->json([
                    "status" => "success",
                    "response" => $patrol
                ]);
            } else {
                return response()->json([
                    "errors"=>"Echec de traitement de la requête !"
                ], );
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], );
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['errors' => $e->getMessage()], );
        }
    }



    /**
     * Calcul de la distance entre deux points GPS en mètres
     * Utilisation de la formule de Haversine
    */
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000; // Rayon de la Terre en mètres
        // Conversion des degrés en radians
        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        // Différence des latitudes et longitudes
        $latDiff = $lat2 - $lat1;
        $lngDiff = $lng2 - $lng1;

        // Application de la formule de Haversine
        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos($lat1) * cos($lat2) *
            sin($lngDiff / 2) * sin($lngDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Calcul de la distance
        $distance = $earthRadius * $c;
        return $distance; // Distance en mètres
    }



    /**
     * Allow to delete some data 
     * It change the status of tuple to deleted
    */
    public function triggerDelete(Request $request):JsonResponse
    {
        try {
            $data = $request->validate([
                'table'=>'required|string',
                'id'=>'required|int'
            ]);
            
            $result = DB::table($data['table'])
                ->where('id', $data['id'])
                ->update(['status' => 'deleted']);
            return response()->json([
                "status"=>"success",
                "result"=>$result
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
     * Test generate PDF
     * @param int|null $eventID
     * @return Response
     */
    public function generatePdfWithQRCodes(int $siteId)
    {
        // Récupérer les zones actives pour un site donné
        $areas = Area::where("site_id", $siteId)
                    ->where("status", "actif")
                    ->get(); // Utilisez get() pour exécuter la requête et récupérer les données

        // Vérifier si des zones existent pour éviter de générer un PDF vide
        $data = ['areas' => $areas];

        // Générer le PDF avec la vue Blade
        $pdf = Pdf::loadView('pdf.invoice', $data)
                ->setPaper('a4')
                ->setOption('margin-top', 10);

        // Télécharger le fichier PDF
        return $pdf->download('areas_qrcodes_printing_'.$siteId.'.pdf');
    }






}