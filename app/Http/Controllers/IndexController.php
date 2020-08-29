<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\VkPost;

class IndexController extends Controller
{
    public function show()
    {
        $posts = VkPost::orderBy('date', 'DESC')->limit(5)->get();

        return view('index')
            ->with('posts', $posts);
    }
}
