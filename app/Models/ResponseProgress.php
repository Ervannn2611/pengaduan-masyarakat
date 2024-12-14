<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'response_id',
        'histories',
    ];

    protected $casts = [
        'histories' => 'array',
    ];

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }
}

