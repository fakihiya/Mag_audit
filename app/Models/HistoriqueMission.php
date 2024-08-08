<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueMission extends Model
{
    use HasFactory;
    protected $table = 'historique_missions';

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'ID_Mission', 'ID_Mission');
    }
}
