<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loan extends Model
{
    protected $fillable = [
        'id_user',
        'id_item',
        'date_loan',
        'date_return',
        'date_returned',
        'quantity',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function item()
    {
        return $this->belongsTo(item_master::class, 'id_item');
    }
}
