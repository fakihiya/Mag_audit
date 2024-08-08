<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('id')->get();
        return view('Dashboard.users', compact('users'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'Nom' => 'required|string|max:245',
            'Prenom' => 'required|string|max:245',
            'email' => 'required|string|email|max:255|unique:users',
            'MotDePasse' => 'required|string|min:8',
            'Sexe' => 'required|in:Masculin,Féminin',
            'Age' => 'required|integer|min:0',
            'Profession' => 'required|string|max:255',
            'EnCouple' => 'required|in:En couple,Seul',
            'TypeVisite' => 'required|in:Visite professionnelle,Visite personnelle',
            'CanalReservation' => 'required|in:site web,tél',
            'Chambre' => 'required|string|max:10',
            'ReservationEffectuee' => 'required|date',
            'role' => 'required|in:user,admin,super admin',
        ]);
        $user = new User();
        $user->Nom = $request->Nom;
        $user->Prenom = $request->Prenom;
        $user->email = $request->email;
        $user->MotDePasse = Hash::make($request->MotDePasse); // Hash the password
        $user->Sexe = $request->Sexe;
        $user->Age = $request->Age;
        $user->Profession = $request->Profession;
        $user->EnCouple = $request->EnCouple;
        $user->TypeVisite = $request->TypeVisite;
        $user->CanalReservation = $request->CanalReservation;
        $user->Chambre = $request->Chambre;
        $user->ReservationEffectuee = $request->ReservationEffectuee;
        $user->role = $request->role;

        $user->save();

        return redirect()->back()->with('success', 'Utilisateur bien ajouté !!');
    }

    public function update(Request $request, $id)
{
    // dd($request->all());
    $user = User::findOrFail($id);

    $validatedData = $request->validate([
        'Nom' => 'required|string|max:245',
        'Prenom' => 'required|string|max:245',
        'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        // // 'MotDePasse' => 'nullable|string|min:8',
        'Sexe' => 'required|in:Masculin,Féminin',
        'role' => 'required|in:admin,user,super admin',
        'Age' => 'required|integer|min:0',
        'Profession' => 'required|string|max:255',
        'EnCouple' => 'required|in:En couple,Seul',
        'TypeVisite' => 'required|in:Visite professionnelle,Visite personnelle',
        'CanalReservation' => 'required|in:site web,tél',
        'Chambre' => 'required|',
        'ReservationEffectuee' => 'required|',
        ]);
        // dd($validatedData);
    // dd($validatedData['ReservationEffectuee']);

    $user->update($validatedData);

    return redirect()->back()->with('success', 'Utilisateur mis à jour avec succès!');
}

public function profile()
{
    $user = auth()->user();
    // dd($user);
    return view('Dashboard.profile', compact('user'));
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    // Validate the incoming request data
    $request->validate([
        'Nom' => 'required|string|max:255',
        'Prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'Sexe' => 'nullable|string',
        'Age' => 'nullable|integer|min:0', // Added minimum value to prevent negative ages
        'Profession' => 'required|string|max:255',
        'EnCouple' => 'nullable|string',
        'TypeVisite' => 'nullable|string',
        'Chambre' => 'nullable|integer|min:0', // Added minimum value to prevent negative room numbers
        'ReservationEffectuee' => 'nullable|date',
        'CanalReservation' => 'nullable|string',
    ]);
 

    // Update user profile with the validated data
    $user->update($request->except(['MotDePasse']));
    // dd($user);

    return redirect()->route('show_profile')->with('success', 'Profile updated successfully');
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        session()->flash('success', "{$user->Nom} deleted successfully");
        return response()->json(['success' => true, 'message' => "{$user->Nom} deleted successfully"]);
    }
}
