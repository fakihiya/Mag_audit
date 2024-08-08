<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Norme extends Model
{
    use HasFactory;
    protected $table = 'normes';

    public function item()
    {
        return $this->belongsTo(Item::class, 'ITEM');
    }

    public function hotelScoresByNorm()
    {
        return $this->hasMany(HotelScoresByNorm::class, 'norm_id');
    }

    public function legende()
    {
        return $this->belongsTo(Legende::class, 'legende');
    }
}
