<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'end_date',
        'is_active',
        'plan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
