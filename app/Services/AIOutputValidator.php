<?php

namespace  App\Services;

class AIOutputValidator
{
    public static function validate(array $data)
    {
        $errors = [];

        $requiredKeys = [
            'full_name',
            'email',
            'phone',
            'skills',
            'years_experience',
            'position_suggested',
            'summary',
            'score',
        ];

        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                $errors[] = "Missing field: {$key}";
            }
        }

        $normalized = [
            'full_name'          => trim($data['full_name'] ?? ''),
            'email'              => strtolower(trim($data['email'] ?? '')),
            'phone'              => preg_replace('/\D+/', '', $data['phone'] ?? ''),
            'skills'             => $data['skills'] ?? [],
            'years_experience'   => $data['years_experience'] ?? null,
            'position_suggested' => trim($data['position_suggested'] ?? ''),
            'summary'            => trim($data['summary'] ?? ''),
            'score'              => $data['score'] ?? null,
        ];

        if ($normalized['full_name'] === '') {
            $errors[] = 'full_name is empty';
            $normalized['full_name'] = null;
        }

        if (
            $normalized['email'] !== '' &&
            !filter_var($normalized['email'], FILTER_VALIDATE_EMAIL)
        ) {
            $errors[] = 'invalid email format';
            $normalized['email'] = null;
        }

        if ($normalized['phone'] !== '' && strlen($normalized['phone']) < 9) {
            $errors[] = 'invalid phone number';
            $normalized['phone'] = null;
        }

        if (!is_array($normalized['skills'])) {
            $errors[] = 'skills is not array';
            $normalized['skills'] = [];
        } else {
            $normalized['skills'] = array_values(array_filter(
                array_map(fn ($s) => trim((string)$s), $normalized['skills'])
            ));
        }

        if (
            !is_null($normalized['years_experience']) &&
            (!is_numeric($normalized['years_experience']) ||
                $normalized['years_experience'] < 0 ||
                $normalized['years_experience'] > 60)
        ) {
            $errors[] = 'invalid years_experience';
            $normalized['years_experience'] = null;
        }

        if (
            !is_null($normalized['score']) &&
            (!is_numeric($normalized['score']) ||
                $normalized['score'] < 0 ||
                $normalized['score'] > 100)
        ) {
            $errors[] = 'invalid score';
            $normalized['score'] = null;
        }

        return [
            'data'     => $normalized,
            'errors'   => $errors,
        ];
    }
}
