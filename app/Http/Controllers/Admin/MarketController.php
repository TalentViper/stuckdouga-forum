<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\ServiceOption;
use App\Models\Setting;

class MarketController extends Controller
{
    public function index()
    {
        $search = Item::all();
        return view('admin.Market.index')->with([
            'search' => $search
        ]);
    }

    public function show($id) {
        return view('admin.Market.index');
    }

    public function remove($id) {
        return view('admin.Market.index');
    }

}
