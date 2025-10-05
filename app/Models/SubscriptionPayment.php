<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPayment extends Model
{
    use softDeletes;

    protected $fillable = [
        'subscription_id',
        'proof',
        'status'
    ];
}
