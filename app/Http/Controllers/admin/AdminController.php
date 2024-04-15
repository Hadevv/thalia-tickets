<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Show;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __invoke()
    {
        $shows = Show::query()
            ->orderBy('created_in', 'desc')
            ->get();
        foreach ($shows as $show) {
            if (is_string($show->created_in)) {
                $show->created_in = Carbon::parse($show->created_in);
            }
        }
        return view('admin.index', [
            'shows' => $shows,
        ]);
    }
}
