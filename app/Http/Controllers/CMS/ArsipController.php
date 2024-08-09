<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class ArsipController extends Controller
{
    public function index()
    {
        return view('cms.pages.arsips.index');
    }
}
