<?php

namespace App\Services;

use App\Models\CV;

class CVService
{
    public function store($file)
    {
        $disk = config('cv.disk');
        $path = config('cv.upload_path');

        $storedPath = $file->store($path, $disk);

        return CV::create([
            'file_path'     => $storedPath,
            'original_name' => $file->getClientOriginalName(),
            'mime_type'     => $file->getClientMimeType(),
            'size'          => $file->getSize(),
        ]);
    }
}
