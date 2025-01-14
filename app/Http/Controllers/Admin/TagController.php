<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\ServiceOption;
use App\Models\Setting;

class TagController extends Controller
{
    public function index()
    {
        $search = Tag::paginate(10);
        return view('admin.tag.index')->with([
            'search' => $search
        ]);
    }

    public function show($id) {
        return view('admin.tag.index');
    }

    public function remove($id) {
        return view('admin.tag.index');
    }

}
