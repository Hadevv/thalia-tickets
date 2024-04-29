<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representation;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __invoke()
    {
        $today = \Carbon\Carbon::now()->toDateString();

        $representations = \App\Models\Representation::where('schedule', '>=', $today)
            ->orderBy('schedule')
            ->take(5)
            ->get();

        return view('home', compact('representations'));
    }
}
