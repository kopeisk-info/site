<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;

use VK\Client\VKApiClient;

class GetPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-posts {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting a list of posts with VK.COM';

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
        if ($id = $this->argument('id')) {
            $vk = new VKApiClient();

            $response = $vk->wall()->get(env('VK_SERVICE_KEY'), [
                'lang' => 'ru',
                'owner_id'  => $id,
                'filter' => 'all',
            ]);

            print_r($response);
        }
    }
}
