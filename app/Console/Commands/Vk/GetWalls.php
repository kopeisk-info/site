<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class GetWalls extends Command
{
    protected $groups = [];
    protected $users = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-walls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting all the walls using VK.COM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $groups = DB::table('church_vk_groups')->union(DB::table('minister_vk_groups'))->get();
        $groups->each(function ($item) {
            if (DB::table('vk_groups')->where('is_closed', 0)->find($item->group_id)) {
                print("Получение последних записей группы с ID {$item->group_id}\n\r");
                Artisan::call('vk:get-posts', ['id' => $item->group_id, '--group' => true]);
            }
        });

        $users = DB::table('minister_vk_users')->get();
        $users->each(function ($item) {
            if (DB::table('vk_users')->where('is_closed', 0)->find($item->user_id)) {
                print("Получение последних записей аккаунта с ID {$item->user_id}\n\r");
                Artisan::call('vk:get-posts', ['id' => $item->user_id]);
            }
        });
    }
}
