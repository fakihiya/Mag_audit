<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelScoresByNorm;
use App\Models\Mission;
use App\Models\Norme;
use Illuminate\Http\Request;

class NormeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($hotel_id, $legende_id, Request $request)
    {
        $hotel = Hotel::findOrFail($hotel_id);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Hotel not found');
        }

        $ID_Mission = $request->ID_Mission;
        $missionbyID = Mission::findOrFail($request->ID_Mission);
        $resume = $missionbyID->resume;
        $hotel_categorie = $hotel->categorie;

        $normesQuery = Norme::with('item')
            ->select('id', 'Normes', $hotel_categorie, "legende", "TYPE", "normes_arabe", "Code_critère", "ITEM")
            ->where($hotel_categorie, '!=', 0);

        if (in_array($legende_id, [1, 2, 3])) {
            $normesQuery->where('legende', $legende_id);
        } elseif ($legende_id == 12) {
            $normesQuery->whereIn('legende', [1, 2, 12]);
        } elseif ($legende_id == 23) {
            $normesQuery->whereIn('legende', [3, 2, 23]);
        } elseif ($legende_id == 123) {
            // No legende condition for 123
        }

        $normes = $normesQuery->paginate(15);

        // Group normes by item after pagination
        $groupedNormes = $normes->groupBy('ITEM');

        $checkExistMission = HotelScoresByNorm::where("mission", $request->ID_Mission)
            ->where('hotel_id', $hotel_id)
            ->first();

        if (!$checkExistMission) {
            foreach ($normes as $norme) {
                $HotelScoresByNorm = new HotelScoresByNorm([
                    'mission' =>  $request->ID_Mission,
                    'hotel_id' => $hotel_id,
                    'norm_id' => $norme->id,
                    'id_item' => $norme->ITEM,
                    'score' =>  $norme->{$hotel_categorie},
                    'verifie' => '_',
                ]);

                $HotelScoresByNorm->save();
            }
        }

        return view('Dashboard.Add_normes', compact('groupedNormes', 'hotel_categorie', 'hotel_id', 'legende_id', 'ID_Mission', 'hotel', 'resume', 'normes'));
    }



    public function getStoredResponses(Request $request)
    {
        $hotel_id = $request->hotel_id;
        $mission_id = $request->mission_id;

        $storedResponses = HotelScoresByNorm::where('hotel_id', $hotel_id)
            ->where('mission', $mission_id)
            ->get();

        return response()->json($storedResponses);
    }

    public function saveNormes(Request $request)
    {

        $validatedData = $request->validate([
            'mission' => 'required|integer',
            'hotel_id' => 'required|integer',
            'norm_id' => 'required|integer',
            'id_item' => 'required|integer',
            'score' => 'nullable|numeric',
            'remarques' => 'nullable|string',
            'verifie' => 'nullable|string',
        ]);

        $hotelScoresByNorm = HotelScoresByNorm::updateOrCreate(
            [
                'mission' => $request->mission,
                'hotel_id' => $request->hotel_id,
                'norm_id' => $request->norm_id,
                'id_item' => $request->id_item
            ],
            [
                'score' => $request->score,
                'remarques' => $request->remarques,
                'verifie' => $request->verifie,
            ]
        );

        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    }

    public function showRe($id)
    {
        dd('asadadads');
        $mission = Mission::findOrFail($id);
        return view('Dashboard.Add_normes', compact('mission'));
    }

    public function storeResume(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'resume' => 'required|string',
        ]);

        // Find the mission and update the resume
        $mission = Mission::findOrFail($id);
        $mission->resume = $request->input('resume');
        $mission->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Resume saved successfully.');
    }



    public function add_norm()
    {
        return view('Dashboard.Add_normes');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Norme $norme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Norme $norme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Norme $norme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
//     public function destroy(Norme $norme)
//     {
//         //
//     }


}