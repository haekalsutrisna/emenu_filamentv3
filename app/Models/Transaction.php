<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'user_id', 
        'code',
        'name',
        'table_number',
        'payment_method',
        'total_price',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactiondetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
