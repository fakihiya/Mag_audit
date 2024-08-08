<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loginForm()
    {
        return view('Auth.login');
    }
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email'],
            'MotDePasse' => ['required', 'string']
        ]);

        $form = $request->only('email', 'MotDePasse');
        
        $user = User::where('email', $form['email'])->first();
    
        if ($user && Hash::check($form['MotDePasse'], $user->MotDePasse)) {
            if (Hash::needsRehash($user->MotDePasse)) {
                $user->MotDePasse = Hash::make($form['MotDePasse']);
                $user->save();
            }
    
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/overview');
        }
    
        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }
    
    



        public function index()
        {
            return view('Auth.register');
        }
       
        public function register(Request $request)
        {
            $request->validate([
                // 'Nom' => ['required', 'string', 'max:255'],
                // 'Prenom' => ['required', 'string', 'max:255'],
                // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // 'MotDePasse' => ['required', 'string', 'min:8', 'confirmed'],
                // 'Sexe' => ['required', 'string', 'max:255'],
                // 'Age' => ['required', 'integer'],
                // 'Profession' => ['required', 'string', 'max:255'],
                // 'Chambre' => ['required', 'integer'],
                'ReservationEffectuee' => ['required', 'date', 'after_or_equal:today'],
                // 'EnCouple' => ['required', 'string', 'max:255'],
                // 'TypeVisite' => ['required', 'string', 'max:255'],
                // 'CanalReservation' => ['required', 'string', 'max:255'],
            ]);
        
            $form = $request->only([
                'Nom',
                'Prenom',
                'email',
                'MotDePasse',
                'Sexe',
                'Age',
                'Profession',
                'Chambre',
                'ReservationEffectuee',
                'EnCouple',
                'TypeVisite',
                'CanalReservation'
            ]);
        
            $form['MotDePasse'] = Hash::make($form['MotDePasse']);
        
            $user = User::create($form);
        
            Auth::login($user);
        
            return redirect('/overview');
        }
        


    


    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }





}
