<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('cms.pages.categories.index');
    }
}
