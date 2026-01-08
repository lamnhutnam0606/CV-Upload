<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CVAIService
{
    public function analyze($cv)
    {
        $text = $this->normalizeText($cv->raw_text ?? []);

        $prompt = str_replace(
            '{{CV_TEXT}}',
            $text,
            config('cv.ai_prompt')
        );

        $response = Http::withToken(config('cv.openai.api_key'))
            ->post('https://api.openai.com/v1/responses', [
            'model' => 'gpt-4o-mini',
            'input' => $prompt,
        ]);

       if (!$response->successful()) {
            logger()->error('OpenAI error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            throw new \Exception('OpenAI API error');
        }

        return $this->extractJson($response->json());
    }

    //lean and parse
    public function extractJson(array $response)
    {
        return $response['output'][0]['content'][0]['text']
            ?? throw new \RuntimeException('Invalid AI JSON structure');
    }

    protected function normalizeText(string $text)
    {
        $text = trim($text);

        if (str_starts_with($text, '{')) {
            $decoded = json_decode($text, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($decoded['text'])) {
                $text = $decoded['text'];
            }
        }

        $text = preg_replace('/\s+/', ' ', $text);

        return Str::limit(trim($text), 10_000);
    }
}
