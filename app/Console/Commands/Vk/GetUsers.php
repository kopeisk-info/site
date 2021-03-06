<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;

use VK\Client\VKApiClient;
use App\VkUser;

class GetUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-users {ids?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting a list of users with VK.COM';

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
        $vk = new VKApiClient();

        if ($ids = $this->argument('ids')) {
            $ids = explode(',', $ids);
        } else {
            $collection = VkUser::get();
            $ids = $collection->modelKeys();
        }

        $response = $vk->users()->get(env('VK_SERVICE_KEY_'. rand (1, 2)), [
            'lang' => 'ru',
            'fields' => [
                'photo_50',
                'screen_name',
                'sex',
                'can_see_all_posts'
            ],
            'user_ids' => $ids,
        ]);

        foreach ($response as $item) {
            VkUser::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
