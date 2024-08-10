<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';

    protected $fillable = [
        'libelle',
        'categories_item_id',
    ];

    public $timestamps = false;
    public function category()
    {
        return $this->belongsTo(CategorieItem::class, 'categories_item_id');
    }
    public function normes()
    {
        return $this->hasMany(Norme::class, 'ITEM');
    }
}
