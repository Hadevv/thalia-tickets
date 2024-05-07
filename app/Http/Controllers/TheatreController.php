<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class TheatreController extends Controller
{
    public function index()
    {

        return view('theatre.index');
    }

    public function show($id)
    {
        return view('theatre.show', ['id' => $id]);
    }
}
