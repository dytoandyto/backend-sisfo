<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class item_master extends Model
{
    protected $fillable = [
        'item_code',
        'item_name',
        'item_code',
        'item_brand',
        'image',
        'item_category',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(categories::class, 'item_category');
    }
    public function loan()
    {
        return $this->hasMany(loan::class);
    }
}
