<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function create(Request $request)
    {
        $allowIps=explode(',', env('ALLOW_IPS'));
        if (!in_array($request->getClientIp(), $allowIps)) {
            abort(404);
        }

        return view('news_create')
            ->with('churches', DB::table('churches')->get(['id', 'name']))
            ->with('ministers', DB::table('ministers')->get(['id', 'first_name', 'last_name']));
    }
}
