<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = [
        'name_category',
        'description'
    ];

    public function item() {
        return $this->hasMany(item_master::class);
    }
    
}
