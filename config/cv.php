<?php

return [
    'disk' => env('CV_DISK', 'public'),
    'upload_path' => 'cvs',
    'allowed_mimes' => [
        'application/pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ],

    'max_size' => 5 * 1024,
];
