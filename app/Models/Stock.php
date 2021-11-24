<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'portfolio';

    protected $fillable = [
        'company',
        'symbol',
        'quantity',
        'buy_price',
        'total_price',
        'sell_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
