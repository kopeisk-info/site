<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\News;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'date_at'=> 'required|date',
            'description' => 'required',
        ]);

        $data = $request->all();
        if ($image = $request->file('image')) {
            $storage = Storage::disk('public');
            $data['image'] = $storage->put('news', $image);
        }
        $news = new News($data);
        $news->save();

        return $this->index($request);
    }
}
