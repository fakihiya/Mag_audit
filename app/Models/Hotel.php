<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nom',
        'categorie',
        'Adresse',
        'type',
        'ville_id',
        'Nom_de_responsable',
        'tele_de_responsable',
        'tele_hotel',
        'siteweb',
        'email_hotel',
        'logo',
    ];

    protected $table = 'hotels';

    public function typeEtablissement()
    {
        return $this->belongsTo(TypeEtablissement::class, 'type');
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    public function hotelScoresByNorm()
    {
        return $this->hasMany(HotelScoresByNorm::class);
    }

    public function missions()
    {
        return $this->hasMany(Mission::class, 'hotel_id', 'id');
    }
}