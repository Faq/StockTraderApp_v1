<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'portfolio_transactions';

    protected $fillable = [
        'symbol',
        'quantity',
        'credits_amount',
        'action'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
