<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Repent;
use App\VkUser;

class RepentController extends Controller
{
    public function index(Repent $repent)
    {
        $repent = $repent->inRandomOrder()->first();
        $id = 80955008;
        $declension = 'Антоном Труфановым';
        if (3 != $repent->minister_id) {
            $id = 40861505;
            $declension = 'Ярославом Левченко';
        }

        $user = VkUser::find($id);

        return view('repent')
            ->with('prayer', $repent->prayer)
            ->with('name', $user->name)
            ->with('photo', $user->photo_50)
            ->with('city', $repent->minister->city)
            ->with('from_link', 'https://vk.com/'. $user->screen_name)
            ->with('declension', $declension);
    }
}
