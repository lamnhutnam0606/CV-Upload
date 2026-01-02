<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ApplyCVController extends Controller
{
    public function create()
    {
        return Inertia::render('apply-cv', [
            'title' => 'Apply CV',
        ]);
    }
}
