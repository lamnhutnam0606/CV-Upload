<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CV extends Model
{
    // use HasUuids;
    protected $table = 'cvs';
    protected $fillable = [
        'uuid',
        'file_path',
        'original_name',
        'mime_type',
        'size',
        'email',
        'phone',
        'full_name',
        'raw_text',
        'ai_result',
        'ai_status',
    ];

    public $casts = [
        'ai_result' => 'array',
    ];
}
