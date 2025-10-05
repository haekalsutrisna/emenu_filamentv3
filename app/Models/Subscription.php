<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use softDeletes;
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
