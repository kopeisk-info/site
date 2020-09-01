<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use App\VkUser;

class WallUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:wall-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting a walls of users with VK.COM';

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
        $users = VkUser::where('from_copy', 0)
            ->where('can_see_all_posts', 1)
            ->updateOlderThan(5)
            ->orderBy('updated_at')
            ->limit(100)
            ->get();

        foreach ($users->modelKeys() as $key => $id) {
            Artisan::call('vk:get-posts', ['id' => $id]);
            $users->get($key)->touch();
        }
    }
}
