<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class TrendingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'videos' => Video::orderByUniqueViews()->get()
        ]);
    }
}
