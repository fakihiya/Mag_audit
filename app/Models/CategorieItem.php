<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieItem extends Model
{
    use HasFactory;

    protected $table = "categories_items";

    protected $fillable = [
        'libele',
        'ponderation',
    ];

    public $timestamps = false;
    public function items()
    {
        return $this->hasMany(Item::class, 'categories_item_id');
    }

    
}
