<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffProvince extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'province',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

