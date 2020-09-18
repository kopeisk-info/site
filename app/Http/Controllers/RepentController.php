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
        $repent = $repent->inRandomOrder()->firstOrFail();
        $minister = $repent->minister;
        $ordination = $minister->ordination;
        $church = $ordination->church;
        $vk = $minister->vkUsers->first();
        //$id = 80955008;
        //$declension = 'Антоном Труфановым';
        //if (3 != $repent->minister_id) {
        //    $id = 40861505;
        //    $declension = 'Ярославом Левченко';
        //}

        //$user = VkUser::find($id);

        return view('repent')
            ->with('prayer', $repent->prayer)
            ->with('name', $minister->full_name)
            ->with('ordination', $ordination->ordination)
            ->with('photo', $vk->photo_50)
            ->with('church', $church->name)
            ->with('city', $church->city)
            ->with('from_link', 'https://vk.com/'. $vk->screen_name);
    }
}
