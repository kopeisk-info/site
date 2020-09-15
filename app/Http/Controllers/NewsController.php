<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\News;

class NewsController extends Controller
{
    public function index(News $news)
    {
        $news = $news->orderByDesc('date_at')->with(['church', 'minister'])->paginate(18);
        return view('news')->with('news', $news);
    }

    public function show(News $news, $id)
    {
        $news = $news->with(['church', 'minister'])
            ->where('date_at', date('Y-m-d H:i:s', substr($id, 0, 10)))
            ->where('id', substr($id, 10))
            ->firstOrFail();
        return view('news_show', ['news' => $news]);
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
