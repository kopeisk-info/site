<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use App\VkGroup;

class WallGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:wall-groups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting a walls of groups with VK.COM';

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
        $groups = VkGroup::where('from_copy', 0)->updateOlderThan(5)->orderBy('updated_at')->limit(20)->get();

        foreach ($groups->modelKeys() as $key => $id) {
            Artisan::call('vk:get-posts', [
                'id' => $id,
                '--group' => true
            ]);
            $groups->get($key)->touch();
        }
    }
}
