<?php

namespace App\Services;

use App\Models\CV;
use Illuminate\Support\Facades\Storage;

class CVService
{
    public function store($file, string $uuid)
    {
        // $disk = config('cv.disk');
        // $path = config('cv.upload_path');

        // $storedPath = $file->store($path, $disk);
        $filename = $uuid . '.' . $file->getClientOriginalExtension();

        $path = Storage::disk('public')->putFileAs(
            'cvs',
            $file,
            $filename,
        );

        return CV::create([
            'uuid'          => $uuid,
            'file_path'     => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type'     => $file->getClientMimeType(),
            'size'          => $file->getSize(),
        ]);
    }
}
