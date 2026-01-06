<?php

namespace App\Jobs;

use App\Services\ChatworkService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class NotifyChatworkJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public int $tries = 3;
    public int $timeout = 10;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $payload
    ) {}

    /**
     * Execute the job.
     */
    public function handle(ChatworkService $chatwork): void
    {
        $chatwork->notify($this->payload['message']);
    }
}
