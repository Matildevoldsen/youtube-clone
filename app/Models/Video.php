<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumbnail_path',
        'original_file_path',
        'live_at',
        'tags'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($video) {
            $video->uuid = (string) Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formats(): HasMany
    {
        return $this->hasMany(VideoFormat::class);
    }
}
