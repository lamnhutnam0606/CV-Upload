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
    'ai_prompt' => <<<PROMPT
        You are an system analyst CV to HR assistant.

        Mission:
        - Analyst content CV
        - Retrieve information
        - Rate leve conform summary

        Required:
        - Return JSON
        - Not add any text except JSON
        - Correct schema later
        {
            "full_name": "",
            "email": "",
            "phone": "",
            "skills": [],
            "years_experience": 0,
            "position_suggested": "",
            "summary": "",
            "score": 0
        }
            
        CV:
        {{CV_TEXT}}
    PROMPT,
];
