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
    You are an AI system that analyzes candidate CVs for HR.

    MISSION:
    - Analyze the CV content
    - Extract candidate information
    - Evaluate overall suitability

    STRICT REQUIREMENTS:
    - Return ONLY valid JSON
    - DO NOT add any explanation, text, or markdown
    - DO NOT wrap the JSON in code blocks
    - Follow EXACTLY the schema below
    - If information is missing, return an empty string or 0

    JSON SCHEMA:
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

    CV CONTENT:
    {{CV_TEXT}}
    PROMPT,

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
    ],
];
