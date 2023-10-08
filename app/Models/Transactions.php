<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_username',
        'from_username',
        'transaction_amount',
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
