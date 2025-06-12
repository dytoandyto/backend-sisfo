<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class return_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_loan',
        'id_user',
        'id_item',
        'return_date',
        'quantity',
        'notes',
        'condition'
    ];
    public function loan()
    {
        return $this->belongsTo(loan::class, 'id_loan');
    }
    public function item()
    {
        return $this->belongsTo(item_master::class, 'id_item');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
