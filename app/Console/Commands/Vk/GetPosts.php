<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Log;

use VK\Client\VKApiClient;
use App\VkPost;

class GetPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-posts {id?} {--group}';

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
            try {
                $response = $vk->wall()->get(env('VK_SERVICE_KEY'), [
                    'lang' => 'ru',
                    'owner_id'  => $this->option('group') ? "-$id" : $id,
                    'filter' => 'all',
                ]);

                foreach($response['items'] as $item) {
                    VkPost::updateOrCreate([
                        'owner_id' => $item['owner_id'],
                        'id' => $item['id']
                    ], $item);
                };
            } catch (RuntimeException $exception) {
                Log::info('Ошибка загрузки id '. $id);
            }
        }
    }
}
