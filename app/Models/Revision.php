<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;
    protected $table = 'revisions';

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'ID_Mission', 'ID_Mission');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }
}
