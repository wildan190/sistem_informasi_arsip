<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Arsip;
use App\Models\Category;

class ArsipController extends Controller
{
    public function index()
    {
        $arsips = Arsip::with('category')->get();

        return view('cms.pages.arsips.index', compact('arsips'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('cms.pages.arsips.create', compact('categories'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);
        if (request('attachment')) {
            $data['attachment'] = request('attachment')->store('attachment');
        }
        Arsip::create($data);

        return redirect()->route('arsips.index');
    }

    public function edit(Arsip $arsip)
    {
        $categories = Category::all();

        return view('cms.pages.arsips.edit', compact('arsip', 'categories'));
    }

    public function update(Arsip $arsip)
    {
        $data = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);
        if (request('attachment')) {
            $data['attachment'] = request('attachment')->store('attachment');
        }
        $arsip->update($data);

        return redirect()->route('arsips.index');
    }

    public function show(Arsip $arsip)
    {
        $arsip->load('category');

        return view('cms.pages.arsips.show', compact('arsip'));
    }

    public function download(Arsip $arsip)
    {
        return response()->download(storage_path('app/'.$arsip->attachment));
    }

    public function destroy(Arsip $arsip)
    {
        $arsip->delete();

        return redirect()->route('arsips.index');
    }
}
