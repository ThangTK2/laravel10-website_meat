<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $topBanner = Banner::where('position', 'top-banner')->where('status', 1)->orderBy('prioty', 'asc')->first();
        $galleries = Banner::where('position', 'gallery')->where('status', 1)->orderBy('prioty', 'asc')->get();
        return view('home.index', compact('topBanner', 'galleries'));
    }

    public function about() {
        return view('home.about');
    }
}
