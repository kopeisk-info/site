<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;

use VK\Client\VKApiClient;
use App\VkGroup;

class GetGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-groups {ids?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting a list of groups with VK.COM';

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
            $collection = VkGroup::get();
            $ids = $collection->modelKeys();
        }

        $response = $vk->groups()->getById(env('VK_SERVICE_KEY'), [
            'lang' => 'ru',
            'group_ids'  => $ids,
            'fields' => [
                'photo_50',
            ],
        ]);

        foreach ($response as $item) {
            VkGroup::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
