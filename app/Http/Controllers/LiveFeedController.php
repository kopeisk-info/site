<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\VkPost;

class LiveFeedController extends Controller
{
    public function index(VkPost $post, $year = null)
    {
        $result = DB::select("show table status where name like 'vk_posts'")[0];
        $status = [
            'rows' => $result->Rows,
            'update_time' => $result->Update_time ? Carbon::createFromTimeString($result->Update_time): ''
        ];

        $years = DB::table('vk_posts')
            ->select(DB::raw("YEAR(date) as year"))
            ->orderByDesc(DB::raw("YEAR(date)"))
            ->groupBy(DB::raw("YEAR(date)"))
            //->distinct()
            ->get();

        $year = Carbon::now()->setYear($year)->year ?: Carbon::now()->year;
        foreach ($years as $key => $item) {
            $item->link = route('live_feed');
            $item->active = false;

            if ($key) {
                $item->link = route('live_feed', $item->year);
            }
            if ($year === $item->year) {
                $item->active = true;
            }

            $years[$key] = $item;
        }

        $posts = $post->withoutTrashed()
            ->whereYear('date', $year)
            ->orderByDesc('date')
            ->paginate(18);

        return view('live-feed')
            ->with('posts', $posts)
            ->with('status', (object) $status)
            ->with('years', $years);
    }

    public function pastor(VkPost $post, $year = null)
    {
        $result = DB::select("show table status where name like 'vk_posts'")[0];
        $status = [
            'rows' => $result->Rows,
            'update_time' => $result->Update_time ? Carbon::createFromTimeString($result->Update_time): ''
        ];

        $years = DB::table('vk_posts')
            ->select(DB::raw("YEAR(date) as year"))
            ->orderByDesc(DB::raw("YEAR(date)"))
            ->groupBy(DB::raw("YEAR(date)"))
            //->distinct()
            ->get();

        $year = Carbon::now()->setYear($year)->year ?: Carbon::now()->year;
        foreach ($years as $key => $item) {
            $item->link = route('live_feed.pastor');
            $item->active = false;

            if ($key) {
                $item->link = route('live_feed.pastor', $item->year);
            }
            if ($year === $item->year) {
                $item->active = true;
            }

            $years[$key] = $item;
        }

        $posts = $post->withoutTrashed()
            ->whereYear('date', $year)
            ->where('owner_id', '>', 0)
            ->orderByDesc('date')
            ->paginate(18);

        return view('live-feed')
            ->with('posts', $posts)
            ->with('status', (object) $status)
            ->with('years', $years);
    }

    public function church(VkPost $post, $year = null)
    {
        $result = DB::select("show table status where name like 'vk_posts'")[0];
        $status = [
            'rows' => $result->Rows,
            'update_time' => $result->Update_time ? Carbon::createFromTimeString($result->Update_time): ''
        ];

        $years = DB::table('vk_posts')
            ->select(DB::raw("YEAR(date) as year"))
            ->orderByDesc(DB::raw("YEAR(date)"))
            ->groupBy(DB::raw("YEAR(date)"))
            //->distinct()
            ->get();

        $year = Carbon::now()->setYear($year)->year ?: Carbon::now()->year;
        foreach ($years as $key => $item) {
            $item->link = route('live_feed.church');
            $item->active = false;

            if ($key) {
                $item->link = route('live_feed.church', $item->year);
            }
            if ($year === $item->year) {
                $item->active = true;
            }

            $years[$key] = $item;
        }

        $posts = $post->withoutTrashed()
            ->whereYear('date', $year)
            ->where('owner_id', '<', 0)
            ->orderByDesc('date')
            ->paginate(18);

        return view('live-feed')
            ->with('posts', $posts)
            ->with('status', (object) $status)
            ->with('years', $years);
    }
}
