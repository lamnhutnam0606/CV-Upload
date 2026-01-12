<?php

namespace App\Jobs;

use App\Models\CV;
use App\Services\CVAIService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class AnalyzeCVJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public $cvId;
    /**
     * Create a new job instance.
     */
    public function __construct($cvId)
    {
        $this->cvId = $cvId;
    }

    /**
     * Execute the job.
     */
    public function handle(CVAIService $cvAIService)
    {
        $cv = CV::find($this->cvId);
        if (!$cv) return;

        try {
            $result = $cvAIService->analyze($cv);
            $respone = json_decode($result, true);
            $cv->update([
                'ai_result' => $result,
                'ai_status' => 'done',
                'email' => $respone['email'] ?? null,
                'phone' => $respone['phone'] ?? null,
                'full_name' => $respone['full_name'] ?? null,
            ]);
        } catch (\Throwable $e) {
            $cv->update(['ai_status' => 'failed']);
            throw $e;
        }
    }
}
