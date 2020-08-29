<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\VkPost;

class LiveFeedController extends Controller
{
    public function index(VkPost $post)
    {
        $result = DB::select("show table status where name like 'vk_posts'")[0];
        $status = [
            'rows' => $result->Rows,
            'update_time' => Carbon::createFromTimeString($result->Update_time)
        ];

        return view('live-feed')
            ->with('posts', $post->orderByDesc('date')->paginate(18))
            ->with('status', (object) $status);
    }
}
