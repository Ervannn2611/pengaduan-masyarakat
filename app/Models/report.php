<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'type',
        'province',
        'regency',
        'subdistrict',
        'village',
        'voting',
        'viewers',
        'image',
        'statement',
    ];

    protected $casts = [
        'voting' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }


    public function responseProgress()
    {
        return $this->hasManyThrough(
            ResponseProgress::class,
            Response::class,
            'report_id',
            'response_id',
            'id',
            'id'
        );
    }
}
