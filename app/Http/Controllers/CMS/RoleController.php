<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return view('cms.pages.roles.index');
    }
}
