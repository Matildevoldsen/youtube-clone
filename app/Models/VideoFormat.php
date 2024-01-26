<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoFormat extends Model
{
    use HasFactory;

    protected $fillable = [
        'quality',
        'file_path',
        'video_id'
    ];
}
