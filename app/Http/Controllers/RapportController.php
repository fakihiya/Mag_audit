<?php
namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelScoresByNorm;
use App\Models\Item;
use App\Models\Mission;
use App\Models\Norme;
use App\Models\User;
use App\Models\Visite;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index($hotel_id, $legende_id, Request $request)
    {
        $ID_Mission = $request->ID_Mission;
        $missionActulle = Mission::with('user')->where('ID_Mission',$request->ID_Mission)->first();
        // dd($missionActulle);
        $hotel = Hotel::find($hotel_id);
        $hotelLogo = Hotel::find($hotel_id)->logo;
        // dd($hotelLogo);
        $missionbyID = Mission::findOrFail($request->ID_Mission);
        $resume = $missionbyID->resume;

        if (!$hotel) {
            return redirect()->back()->with('error', 'Hotel not found');
        }

        $hotel_categorie = $hotel->categorie;

        $normes = HotelScoresByNorm::with('norm', 'item')
            ->where('hotel_id', $hotel_id)
            ->where('mission', $ID_Mission)
            ->get();

        $mission = Mission::where('hotel_id', $hotel_id)->first();
        if (!$mission) {
            return redirect()->back()->with('error', 'Mission not found');
        }



        $auditor = User::with('missions')->where('id', $mission->user_id)->first();
        if (!$auditor) {
            return redirect()->back()->with('error', 'Auditor not found');
        }

        // $scores = HotelScoresByNorm::with(['item.category'])
        // ->select('id_item')
        // ->selectRaw('SUM(CASE WHEN score > 1.00 THEN score ELSE 0 END) as total_score')
        // ->selectRaw('SUM(CASE WHEN score > 1.00 AND verifie = "conforme" THEN score ELSE 0 END) as total_score_conforme')
        // ->where('hotel_id', $hotel_id)
        // ->where('mission', $ID_Mission)
        // ->groupBy('id_item')
        // ->get();

        $scores = HotelScoresByNorm::with(['item.category'])
    ->select('id_item')
    ->selectRaw('SUM(CASE WHEN score > 1.00 THEN score ELSE 0 END) as total_score')
    ->selectRaw('SUM(CASE WHEN score > 1.00 AND verifie = "conforme" THEN score ELSE 0 END) as total_score_conforme')
    ->selectRaw('SUM(CASE WHEN verifie = "conforme" THEN 1 ELSE 0 END) as total_conforme')
    ->selectRaw('SUM(CASE WHEN verifie = "non_conforme" THEN 1 ELSE 0 END) as total_non_conforme')
    ->where('hotel_id', $hotel_id)
    ->where('mission', $ID_Mission)
    ->groupBy('id_item')
    ->get();



        $scoresGlobale = HotelScoresByNorm::selectRaw('SUM(CASE WHEN score > 1.00 THEN score ELSE 0 END) as total_score_globale')
            ->selectRaw('SUM(CASE WHEN score > 1.00 AND verifie = "conforme" THEN score ELSE 0 END) as total_score_conforme_globale')
            ->where('hotel_id', $hotel_id)
            ->where('mission', $ID_Mission)
            ->first();

        $visites = Visite::where('mission_id', $request->ID_Mission)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get(['score', 'mission_id', 'user_id', 'created_at']);

        return view('Rapport.rapport', compact('missionActulle', 'hotelLogo', 'normes', 'hotel_categorie', 'auditor', 'ID_Mission', 'scores', 'scoresGlobale', 'visites', 'hotel_id', 'legende_id', 'resume'));
    }

    public function voirRapport()
    {
        return view('Rapport.rapport');
    }
//pdf

public function generatePdf($hotel_id, $legende_id, $ID_Mission)
{
    $missionActulle = Mission::with('user')->where('ID_Mission', $ID_Mission)->first();
    $hotel = Hotel::find($hotel_id);
    $hotelLogo = $hotel->logo;
    $missionbyID = Mission::findOrFail($ID_Mission);
    $resume = $missionbyID->resume;

    $hotel_categorie = $hotel->categorie;

    $normes = HotelScoresByNorm::with('norm', 'item')
        ->where('hotel_id', $hotel_id)
        ->where('mission', $ID_Mission)
        ->get();

    $mission = Mission::where('hotel_id', $hotel_id)->first();
    $auditor = User::with('missions')->where('id', $mission->user_id)->first();

    $scores = HotelScoresByNorm::with('item')->select('id_item')
        ->selectRaw('SUM(CASE WHEN score > 1.00 THEN score ELSE 0 END) as total_score')
        ->selectRaw('SUM(CASE WHEN score > 1.00 AND verifie = "conforme" THEN score ELSE 0 END) as total_score_conforme')
        ->where('hotel_id', $hotel_id)
        ->where('mission', $ID_Mission)
        ->groupBy('id_item')
        ->get();

    $scoresGlobale = HotelScoresByNorm::selectRaw('SUM(CASE WHEN score > 1.00 THEN score ELSE 0 END) as total_score_globale')
        ->selectRaw('SUM(CASE WHEN score > 1.00 AND verifie = "conforme" THEN score ELSE 0 END) as total_score_conforme_globale')
        ->where('hotel_id', $hotel_id)
        ->where('mission', $ID_Mission)
        ->first();

    $visites = Visite::where('mission_id', $ID_Mission)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get(['score', 'mission_id', 'user_id', 'created_at']);

    $data = [
        'missionActulle' => $missionActulle,
        'hotelLogo' => $hotelLogo,
        'normes' => $normes,
        'hotel_categorie' => $hotel_categorie,
        'auditor' => $auditor,
        'ID_Mission' => $ID_Mission,
        'scores' => $scores,
        'scoresGlobale' => $scoresGlobale,
        'visites' => $visites,
        'hotel_id' => $hotel_id,
        'legende_id' => $legende_id,
        'resume' => $resume
    ];

    $pdf = PDF::loadView('pdf_view', $data);
    return $pdf->download('rapport.pdf');
}

}
