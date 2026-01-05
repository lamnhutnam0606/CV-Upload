<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CV extends Model
{
    protected $table = 'cvs';
    protected $fillable = [
        'file_path',
        'original_name',
        'mime_type',
        'size',
        'email',
        'full_name',
        'raw_text',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
