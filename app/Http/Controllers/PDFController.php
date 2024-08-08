<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Item;
use App\Models\Mission;
use App\Models\Norme;
use App\Models\User;
use App\Models\HotelScoresByNorm;
use App\Models\Visite;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    // Controller method


    // public function generatePdf($hotelId, $missionId, Request $request)
    // {
    //     // Fetch the mission based on $missionId
    //     $mission = Mission::where('ID_Mission', $missionId)->first();
    //     if (!$mission) {
    //         return redirect()->back()->with('error', 'Mission not found');
    //     }
    
    //     // Fetch hotel based on $hotelId
    //     $hotel = Hotel::find($hotelId);
    //     if (!$hotel) {
    //         return redirect()->back()->with('error', 'Hotel not found');
    //     }
    
    //     // Ensure $hotel is an object, not an array
    //     if (!is_object($hotel)) {
    //         return redirect()->back()->with('error', 'Invalid hotel data');
    //     }
    
    //     // Example: Fetching totalScoreConformeGlobale from $hotel
    //     // $totalScoreConformeGlobale = $hotel->total_score_conforme_globale ?? 0;
    
    //     // Fetch norms related to the specified hotel category and legendes
    //     $normes = Norme::with('item')
    //         ->selectRaw('ITEM, COUNT(id) as total')
    //         ->whereIn('legende', [2, 1, 3, 12, 23, 123])
    //         ->where($hotel->categorie, '!=', 0)
    //         ->groupBy('ITEM')
    //         ->get();
    
    //     // Fetch items related to norms
    //     $items = Item::whereIn('id', $normes->pluck('ITEM'))->get()->keyBy('id');
    
    //     // Fetch auditor related to the mission
    //     $auditor = User::find($mission->user_id);
    //     if (!$auditor) {
    //         return redirect()->back()->with('error', 'Auditor not found');
    //     }
    
    //     // Calculate scores
    //     $scoresGlobale = [];
    //     foreach ($normes as $norme) {
    //         // Example score calculation (replace with your actual logic)
    //         $totalScore = $norme->total * 10;
    //         $scoresGlobale[$norme->ITEM] = $totalScore;
    //     }
    
    //     // Fetch latest 3 visits (inspections) for the mission
    //     $visites = Visite::where('mission_id', $missionId)
    //         ->orderBy('created_at', 'desc')
    //         ->take(3)
    //         ->get(['score', 'mission_id', 'user_id', 'created_at']);
    
    //     // Render the view with the necessary data
    //     $html = view('Rapport.rapport', compact('normes', 'items', 'hotel', 'auditor', 'mission', 'scoresGlobale', 'visites'))->render();
    
    //     // Generate PDF using Dompdf
    //     $pdf = PDF::loadHtml($html);
    //     $pdf->setPaper('A4', 'portrait');
    
    //     // Stream the generated PDF to the user
    //     return $pdf->stream('rapport.pdf');
    // }
    
    





    public function generatePdf($hotel_id, $legende_id, Request $request)
    {
        
        $ID_Mission = $request->ID_Mission;
        $hotel = Hotel::find($hotel_id);
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

        $visites = Visite::where('mission_id', $request->ID_Mission)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get(['score', 'mission_id', 'user_id', 'created_at']);


    $html = view('Rapport.rapport', compact('normes', 'hotel_categorie', 'auditor', 'ID_Mission', 'scores', 'scoresGlobale', 'visites'));
   return $html;
   // Generate PDF using Dompdf
   $pdf = PDF::loadHtml($html);
   $pdf->setPaper('A4', 'portrait');

   // Stream the generated PDF to the user
   return $pdf->download('rapport.pdf');
    }  
}