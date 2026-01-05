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
        'full_name',
        'raw_text',
    ];
}
