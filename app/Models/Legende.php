<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legende extends Model
{
    use HasFactory;
    protected $table = 'table_legende';
    protected $fillable = [
        'Description',
    ];

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }
}
