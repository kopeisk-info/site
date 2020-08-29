<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index()
    {
        return view('news');
    }

    public function show()
    {
        return view('news');
    }
}
