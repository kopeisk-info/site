<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function index()
    {
        return view('events');
    }

    public function show()
    {
        return view('events');
    }
}
