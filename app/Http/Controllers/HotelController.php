<?php
namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::with('ville')->orderByDesc('id')->get();
        $villes = Ville::all(); 
        return view('Dashboard.hotel', compact('hotels', 'villes'));
    }
    

    public function search(Request $request)
    {
        // Start with a base query
        $query = Hotel::query();
    
        // Apply filters conditionally
        if ($request->filled('Nom')) {
            $query->where('Nom', 'like', '%' . $request->Nom . '%');
        }
    
        if ($request->filled('ville')) {
            $query->where('ville_id', $request->ville);
        }
    
        if ($request->filled('categorie') && $request->categorie != '') {
            $query->where('categorie', $request->categorie);
        }
    
        // Get the results
        $hotels = $query->get();
    
        // Get the list of villes for the dropdown
        $villes = Ville::all();
    
        // Return the view with the results and the villes
        return view('Dashboard.hotel', compact('hotels', 'villes'));
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
         $validatedData = $request->validate([
             'Nom' => 'required|string|max:255',
             'categorie' => 'required|string|max:255',
             'Adresse' => 'required|string|max:255',
             'ville_id' => 'required',
             'Nom_de_responsable' => 'required|string|max:255',
             'tele_de_responsable' => 'required',
             'tele_hotel' => 'required',
             'siteweb' => 'required|string|max:255',
             'email_hotel' => 'required|string|email|max:255',
             'type' => 'nullable|exists:type_etablissements,id',
             'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
     
         $hotel = new Hotel();
         $hotel->Nom = $validatedData['Nom'];
         $hotel->categorie = $validatedData['categorie'];
         $hotel->Adresse = $validatedData['Adresse'];
         $hotel->ville_id = $validatedData['ville_id'];
         $hotel->Nom_de_responsable = $validatedData['Nom_de_responsable'];
         $hotel->tele_de_responsable = $validatedData['tele_de_responsable'];
         $hotel->tele_hotel = $validatedData['tele_hotel'];
         $hotel->siteweb = $validatedData['siteweb'];
         $hotel->email_hotel = $validatedData['email_hotel'];
         $hotel->type = $validatedData['type'] ?? 1; // Set default type if not provided
     
         if ($request->hasFile('logo')) {
             $logoPath = $request->file('logo')->store('logos', 'public');
             $hotel->logo = $logoPath;
             Log::info('Logo Path: ' . $logoPath); // Log the logo path
         }
     
         $hotel->save();
     
         return redirect()->back()->with('success', 'Hotel successfully added!');
     }
     
     

    /**
     * Show the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        
        $validatedData = $request->validate([
            'Nom' => 'required|string|max:255',
            'categorie' => 'required|string',
            'Adresse' => 'required|string',
            'ville_id' => 'nullable|exists:villes,id',
            'Nom_de_responsable' => 'required|string|max:255',
            'tele_de_responsable' => 'required|string|max:255',
            'tele_hotel' => 'required|string|max:255',
            'siteweb' => 'required|string|max:255',
            'email_hotel' => 'required|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $logoPath;
        } else {
            // Keep the old logo if no new logo is uploaded
            $validatedData['logo'] = $hotel->logo;
        }
    
        $hotel->update($validatedData);
        
        return redirect()->route('hotels.index')->with('success', 'Hotel updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        session()->flash('success', "{$hotel->Nom} deleted successfully");
        return response()->json(['success' => true, 'message' => "{$hotel->Nom} deleted successfully"]);
    }
}

