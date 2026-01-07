<?php

namespace App\Services;

use App\Models\CV;
use Illuminate\Support\Facades\Http;

class CVAIService
{
    public function analyze($cv)
    {
        $text = is_array($cv->raw_text) 
            ? ($cv->raw_text['text'] ?? '')
            : $cv->raw_text;

        $prompt = str_replace('{{CV_TEXT}}', $text, config('cv.ai_prompt'));

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/responses', [
            'model' => 'gpt-4o-mini',
            'input' => $prompt,
        ]);

        if (!$response->successful()) {
            throw new \Exception('OpenAI API error');
        }

        $raw = $response->json();
        $textOutput = data_get($raw, 'output.0.content.0.text');
        $parsed = $this->parseAIJson($textOutput);
        return [
            'parsed' => $parsed,
            'score'  => $parsed['score'] ?? null,
            'raw'    => $raw,
        ];
    }

    //lean and parse
    public function parseAIJson(string $text)
    {
        $clean = preg_replace('/```json|```/', '', $text);
        $data = json_decode(trim($clean), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid AI JSON response');
        }

        return $data;
    }
}
