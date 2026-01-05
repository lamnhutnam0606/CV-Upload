<?php

namespace App\Http\Controllers;

use App\Http\Requests\CVRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApplyCVController extends Controller
{
    public function create()
    {
        return Inertia::render('ApplyCV', [
            'title' => 'CV',
        ]);
    }

    public function parse(CVRequest $request)
    {
        $fileUpload = $request->validated();
        dd($request->all());
    }
}
