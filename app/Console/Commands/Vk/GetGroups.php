<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;

use VK\Client\VKApiClient;

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
        if (($ids = explode(',', $this->argument('ids'))) && current($ids)) {
            $vk = new VKApiClient();

            $response = $vk->groups()->getById(env('VK_SERVICE_KEY'), [
                'lang' => 'ru',
                'group_ids'  => $ids,
                'fields' => [
                    'photo_50',
                ],
            ]);

            print_r($response);
        }
    }
}
