<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function index()
    {
        return view('cms.pages.logs.index');
    }
}
