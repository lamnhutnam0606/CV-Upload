<?php

return [
    'disk' => env('CV_DISK', 'public'),
    'upload_path' => 'cvs',
    'allowed_mimes' => [
        'application/pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ],

    'max_size' => 5 * 1024,

    //prompt AI analyze
    'ai_prompt' => <<<TEXT
        You are an HR assistant.
        Extract structured information from the CV text below.
        Return JSON with:
        - full_name
        - email
        - phone
        - skills (array)
        - years_of_experience
        - summary (short)
        - score (0–100)

        CV text:
        {{CV_TEXT}}
    TEXT,
];
