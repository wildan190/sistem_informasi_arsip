<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        return view('cms.pages.permissions.index');
    }
}
