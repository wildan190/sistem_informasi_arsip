<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('cms.pages.users.index');
    }
}
