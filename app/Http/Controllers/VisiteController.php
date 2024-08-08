<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visite;

class VisiteController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données entrantes
        $request->validate([
            'score' => 'required|numeric',
            'mission_id' => 'required|exists:missions,ID_Mission',
            'user_id' => 'required|exists:users,id',
        ]);

        // Création d'une nouvelle visite
        $visite = new Visite();
        $visite->score = $request->input('score');
        $visite->mission_id = $request->input('mission_id');
        $visite->user_id = $request->input('user_id');
        $visite->save();

        // Retourner une réponse appropriée
        return back()->with('success', 'Visite enregistrée avec succès');    }
}
