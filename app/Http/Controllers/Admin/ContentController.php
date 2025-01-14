<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Content;
use App\Models\ServiceOption;
use App\Models\Setting;

class ContentController extends Controller
{
    public function index()
    {
        $search = Content::all();
        return view('admin.content.index')->with([
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('admin.content.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Content::create($request->all());

        return redirect()->route('admin.content.index')
                        ->with('success', 'Content created successfully.');
    }

    public function show(Content $content)
    {
        return view('admin.content.show', compact('content'));
    }

    public function edit(Content $content)
    {
        return view('admin.content.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $content->update($request->all());

        return redirect()->route('admin.content.index')
                        ->with('success', 'Content updated successfully.');
    }

    public function destroy(Content $content)
    {
        $content->delete();

        return redirect()->route('admin.content.index')
                        ->with('success', 'Content deleted successfully.');
    }

}
