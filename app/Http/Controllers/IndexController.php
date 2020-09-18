<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\VkPost;
use App\News;

class IndexController extends Controller
{
    public function show()
    {
        $news = News::orderBy('date_at', 'DESC')->limit(5)->get();
        $posts = VkPost::orderBy('date', 'DESC')->limit(3)->get();

        return view('index')
            ->with('news', $news)
            ->with('posts', $posts);
    }
}
