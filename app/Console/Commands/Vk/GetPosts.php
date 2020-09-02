<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Log;

use VK\Client\VKApiClient;
use App\VkUser;
use App\VkGroup;
use App\VkPost;

class GetPosts extends Command
{
    private $profiles = [];
    private $groups = [];
    private $posts = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-posts {id} {--group}';

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
        $id = $this->argument('id');

        // Получаем записи со служебной информацией
        $vk = new VKApiClient();
        $response = $vk->wall()->get(env('VK_SERVICE_KEY'), [
            'lang' => 'ru',
            'owner_id'  => $this->option('group') ? '-'. $id : $id,
            'extended' => 1,
            'filter' => 'all',
            'count' => 10
        ]);

        $this->posts = $response['items'];
        $this->profiles = $response['profiles'];
        $this->groups = $response['groups'];

        // Добавление отсутсвующих зависимостей(профили)
        $profileIds = array_column($this->profiles, 'id');
        $profiles = VkUser::whereIn('id', $profileIds)->get();
        $ids = array_diff($profileIds , $profiles->modelKeys());
        foreach ($ids as $key => $id) {
            $data = $this->profiles[$key];
            $data['from_copy'] = 1;
            VkUser::updateOrCreate(['id' => $id], $data);
        }

        // Добавление отсутсвующих зависимостей(группы)
        $groupIds = array_column($this->groups, 'id');
        $groups = VkGroup::whereIn('id', $groupIds)->get();
        $ids = array_diff($groupIds , $groups->modelKeys());
        foreach ($ids as $key => $id) {
            $data = $this->groups[$key];
            $data['from_copy'] = 1;
            VkGroup::updateOrCreate(['id' => $id], $data);
        }
        dd();

        if ($this->items = $response['items']) {
            $ids = array_merge(
                array_column($response['items'], 'from_id'),
                array_column($response['items'], 'owner_id')
            );
            $ids = array_unique($ids);

            foreach($ids as $id) {
                $id < 0 ? array_push($this->groups, $id) : array_push($this->users, $id);
            }

            /*foreach($response['items'] as $item) {
                VkPost::updateOrCreate([
                    'owner_id' => $item['owner_id'],
                    'id' => $item['id']
                ], $item);
            };

            $keys = array_reverse(array_column($response['items'], 'id'));
            $posts = VkPost::where('owner_id', $item['owner_id'])
                ->whereNotIn('id', $keys)
                ->whereBetween('id', [current($keys), end($keys)])
                ->get();
            foreach ($posts as $post) {
                $post->delete();
            }*/
        }
    }
}
