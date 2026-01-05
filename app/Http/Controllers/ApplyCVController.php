<?php

namespace App\Http\Controllers;

use App\Http\Requests\CVRequest;
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

    public function parse(CVRequest $request)
    {
        $this->cvService->store($request->file('cv_file'));

        // return redirect()->back()->with('flash', [
        //     'type' => 'success',
        //     'message' => 'Upload CV successfull',
        // ]);
        return redirect()->back()->with('success', 'Upload CV successfull');
    }
}
