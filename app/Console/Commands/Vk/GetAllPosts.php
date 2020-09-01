<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use VK\Client\VKApiClient;
use App\VkPost;

class GetAllPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-all-posts {id} {offset?} {--group}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting a list of all posts with VK.COM';

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
        $id = $this->argument('id');
        $offset = $this->argument('offset') ?: 0;
        $vk = new VKApiClient();

        do {
            $response = $vk->wall()->get(env('VK_SERVICE_KEY'), [
                'lang' => 'ru',
                'owner_id'  => $this->option('group') ? "-$id" : $id,
                'count' => 100,
                'offset' => $offset,
                'filter' => 'all',
            ]);

            echo 'id '. $id .', offset '. $offset .', posts '. count($response['items']) .', first '. current($response['items'])['id'] .', last '. end($response['items'])['id'] ."\r\n";

            foreach($response['items'] as $item) {
                VkPost::updateOrCreate([
                    'owner_id' => $item['owner_id'],
                    'id' => $item['id']
                ], $item);
            }

            $offset = $offset + 99;
        } while ($response['items']);
    }
}
