<?php

namespace App\Http\Controllers;

use App\Http\Requests\CVRequest;
use App\Jobs\NotifyChatworkJob;
use App\Models\CV;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Services\CVService;
use Inertia\Inertia;

class ApplyCVController extends Controller
{
    public function __construct(private CVService $cvService)
    {}
    public function create()
    {
        return Inertia::render('ApplyCV', [
            'title' => 'CV',
        ]);
    }

    public function parse(CVRequest $request, CV $cv)
    {
        $uuid = (string) Str::uuid();
        $data = $this->cvService->store($request->file('cv_file'), $uuid);

        $cv::create([
            'uuid' => $uuid,
            ...$data,
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
            📎 File: {$data['original_name']}
            ⏰ Thời gian: {$time}
            [/info]
            TEXT;

        NotifyChatworkJob::dispatch([
            'message' => $message
        ]);

        return redirect()->back()->with('success', 'Upload CV successfull');
    }
}
