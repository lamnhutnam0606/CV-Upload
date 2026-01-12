<?php

namespace App\Http\Controllers;

use App\Http\Requests\CVRequest;
use App\Jobs\AnalyzeCVJob;
use App\Jobs\NotifyChatworkJob;
use App\Models\CV;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Services\CVService;
use Inertia\Inertia;
use Spatie\PdfToText\Pdf;

class ApplyCVController extends Controller
{
    public function __construct(private CVService $cvService)
    {}
    public function create()
    {
        return Inertia::render('cv/apply', [
            'title' => 'CV',
        ]);
    }

    public function list()
    {
        $cvs = CV::latest()->get();
        return Inertia::render('cv/list', [
            'cvs' => $cvs,
        ]);
    }

    public function parse(CVRequest $request)
    {
        $uuid = (string) Str::uuid();
        $cv = $this->cvService->store($request->file('cv_file'), $uuid);
        $cv->update([
            'raw_text' => [
                'text' => Pdf::getText($request->file('cv_file')->getPathname())
            ]
        ]);
        // return redirect()->back()->with('flash', [
        //     'type' => 'success',
        //     'message' => 'Upload CV successfull',
        // ]);

        $time = Carbon::now()->format('Y-m-d H:i:s');
        //message to chatwork
        $message = <<<TEXT
            [info][title]📄 CV mới được nộp[/title]
            👤 Tên: 'Chưa xác định'
            📧 Email: 'Chưa có'
            📎 File: {}
            ⏰ Thời gian: {$time}
            [/info]
            TEXT;

        AnalyzeCVJob::dispatch($cv->id);
        NotifyChatworkJob::dispatch([
            'message' => $message
        ]);

        return redirect()->back()->with('success', 'Upload CV successfull');
    }
}
