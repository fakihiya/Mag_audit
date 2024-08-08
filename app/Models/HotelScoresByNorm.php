<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelScoresByNorm extends Model
{
    use HasFactory;

    protected $table = 'hotel_scores_by_norms';
    protected $fillable = [
        'hotel_id',
        'norm_id',
        'id_item',
        'score',
        'remarques',
        'photo_url',
        'verifie',
        'mission'
    ];
    public $timestamps = false;

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function norm()
    {
        return $this->belongsTo(Norme::class, 'norm_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission', 'ID_Mission');
    }
}
