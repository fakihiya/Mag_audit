<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;
    protected $primaryKey = 'ID_Mission';
    protected $fillable = [


        'Description',
        'Statut',
        'user_id',
        'hotel_id',
        'legende_id',
        'resume',

    ];
    protected $table = 'missions';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function legende()
    {
        return $this->belongsTo(Legende::class);
    }
}
