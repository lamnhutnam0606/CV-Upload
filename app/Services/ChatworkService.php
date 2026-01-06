<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatworkService
{
    public function notify(string $message)
    {
        $a = Http::withHeaders([
            'X-ChatWorkToken' => config('chatwork.token'),
        ])->asForm()
          ->post(
            config('chatwork.endpoint')
            . '/rooms/'
            . config('chatwork.room_id')
            . '/messages',
            ['body' => $message]
        );
    }
}
