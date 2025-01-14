<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Gallery;
use App\Models\ArtWork;
use App\Models\Job;
use App\Models\Rubbish;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //

    public function index()
    {
        try {
            $visits = User::whereDate('updated_at', Carbon::today()->format('Y-m-d'))->count();
            $customerCount = User::all()->count();
            $todaynewcustomerCount = User::whereDate('created_at', Carbon::today()->format('Y-m-d'))->count();
            $totalGalleries = Gallery::all()->count();
            $newGalleries = Gallery::whereDate('created_at', Carbon::today()->format('Y-m-d'))->count();
            $totalMarketItems = ArtWork::all()->count();
            $search = User::orderBy('full_name', 'desc');
            $customers = $search->paginate(5);
            $search = Gallery::orderBy('created_at', 'desc');
            $galleries = $search->paginate(5);
            return view('admin.dashboard')->with([
                'visits' => $visits,
                'totalGalleries' => $totalGalleries,
                'newGalleries' => $newGalleries,
                'totalMarketItems' => $totalMarketItems,
                'customerCount' => $customerCount,
                'todaynewcustomerCount' => $todaynewcustomerCount,
                'customers' => $customers,
                'galleries' => $galleries
            ]);
        } catch (\Exception $e){
            abort(500);
        }
    }
}
