<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'Nom',
        'Prenom',
        'email',
        'MotDePasse',
        'Sexe',
        'role',
        'Age',
        'Profession',
        'EnCouple',
        'TypeVisite',
        'Chambre',
        'ReservationEffectuee',
        'CanalReservation',
    ];

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

