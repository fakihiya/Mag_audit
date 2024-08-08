<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelScoresByNorm;
use App\Models\Legende;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MissionController extends Controller
{
//     public function displayMission()
//     {
    
//         $legendes = Legende::all();
//         $users = User::all();
//         $hotels = Hotel::all();
//         $missions = Mission::orderByDesc('ID_Mission')->get();
// // dd($missions, $legendes, $users, $hotels);
//         return view('Dashboard.mission', compact('missions', 'legendes', 'users', 'hotels'));
//     }


public function displayMission()
{
    $user = Auth::user(); // Get the authenticated user
    Log::info('Authenticated user:', ['id' => $user->id, 'role' => $user->role]);

    $legendes = Legende::all();
    $users = User::all();
    $hotels = Hotel::all();

    // Check if the user has the 'Super Admin' role
    if ($user->hasRole('super admin')) {
        Log::info('User is Super Admin, retrieving all missions');
        // Get all missions for Super Admin
        $missions = Mission::orderByDesc('ID_Mission')->get();
    } else {
        Log::info('User is not Super Admin, retrieving only their missions');
        // Get only the missions created by the authenticated user
        $missions = Mission::where('user_id', $user->id)->orderByDesc('ID_Mission')->get();
    }

    Log::info('Missions retrieved:', ['count' => $missions->count()]);

    return view('Dashboard.mission', compact('missions', 'legendes', 'users', 'hotels'));
}

   

    public function search(Request $request)
    {
        // dd($request);
        $query = Mission::query();

        if ($request->filled('Statut')) {
            $query->where('Statut', $request->Statut);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('legende_id')) {
            $query->where('legende_id', $request->legende_id);
        }

        $missions = $query->get();

        $legendes = Legende::all();
        $users = User::all();
        $hotels = Hotel::all();

        return view('Dashboard.mission', compact('missions', 'legendes', 'users', 'hotels'));
    }

    public function store(Request $request)
    {
    //    dd($request->all());
        $request->validate([
            'Description' => 'required|string|max:255',
            'Statut' => 'required|in:désignée,En cours,Terminée,Annulée',
            'user_id' => 'required|exists:users,id',
            'legende_id' => 'required|exists:table_legende,id',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        // Create a new mission
        $mission = new Mission([
            'Description' => $request->get('Description'),
            'Statut' => $request->get('Statut'),
            'user_id' => $request->get('user_id'),
            'legende_id' => $request->get('legende_id'),
            'hotel_id' => $request->get('hotel_id'),
        ]);
        $mission->save();


       


        // Redirect back with success message
        return redirect()->back()->with('success', 'Mission bien ajoutée!');
    }




       public function edit($id)
   {
        $mission = Mission::findOrFail($id);
        $users = User::all();
        $legendes = Legende::all();
        $hotels = Hotel::all();
        return view('Dashboard.edit_mission', compact('mission', 'users', 'legendes', 'hotels'));
    }
    public function update(Request $request, $id)
    {

        try {
            // Validate the incoming request data
            $request->validate([
                'Description' => 'required|string|max:255',
                'Statut' => 'required|in:En cours,Terminée,Annulée',
                'user_id' => 'required|exists:users,id',
                'legende_id' => 'required|exists:table_legende,id',
                'hotel_id' => 'required|exists:hotels,id',
            ]);

            // Find the mission by ID
            $mission = Mission::findOrFail($id);

            // Update the mission with the new data
            $mission->update($request->only('Description', 'Statut', 'user_id', 'legende_id', 'hotel_id'));

            // Redirect back to the missions index with a success message
            return redirect()->route('showmisson')->with('success', 'Mission updated successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Mission update failed: '.$e->getMessage());

            // Redirect back with an error message
            return redirect()->route('showmisson', $id)->with('error', 'Failed to update mission.');
        }
    }



    public function destroy($id) {
        $mission = Mission::findOrFail($id);
        $mission->delete();
        return redirect()->route('showmisson')->with('success', 'Mission deleted successfully');
    }

    public function details($ID_Mission)
    {
        $users = User::all();
        $legende_id = Legende::all();
        $hotel_id = Hotel::all();

        $mission = Mission::findOrFail($ID_Mission);
        return view('Dashboard.voir_mission', compact('mission' , 'legende_id', 'hotel_id'));
    }





}


