<?php

namespace App\Http\Controllers;

use App\Models\Representation;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __invoke(Request $request)
    {
        $upcomingRepresentations = Representation::where('schedule', '>=', now())
            ->orderBy('schedule')
            ->get();

        return view('schedule.index', compact('upcomingRepresentations'));
    }
}
