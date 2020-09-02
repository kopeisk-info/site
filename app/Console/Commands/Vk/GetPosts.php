<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;

use VK\Client\VKApiClient;
use App\VkUser;
use App\VkGroup;
use App\VkPost;

class GetPosts extends Command
{
    private $id;
    private $profiles;
    private $groups;
    private $posts;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-posts {id} {--G|group} {--count=20} {--offset=0}';

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
        $this->id = $this->argument('id');

        // Получаем записи со служебной информацией
        $vk = new VKApiClient();
        $response = $vk->wall()->get(env('VK_SERVICE_KEY'), [
            'lang' => 'ru',
            'owner_id'  => $this->option('group') ? '-'. $this->id : $this->id,
            'extended' => 1,
            'filter' => 'all',
            'count' => $this->option('count'),
            'offset' => $this->option('offset')
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
            $data['from_copy'] = $this->id != $id;
            VkUser::create($data);
        }

        // Добавление отсутсвующих зависимостей(группы)
        $groupIds = array_column($this->groups, 'id');
        $groups = VkGroup::whereIn('id', $groupIds)->get();
        $ids = array_diff($groupIds , $groups->modelKeys());
        foreach ($ids as $key => $id) {
            $data = $this->groups[$key];
            $data['from_copy'] = 1;
            VkGroup::create($data);
        }

        // Добавление или обновление постов
        foreach($this->posts as $post) {
            VkPost::updateOrCreate([
                'owner_id' => $post['owner_id'], 'id' => $post['id']
            ], $post);
        }

        // Удаление отсуствующих постов
        $ids = array_reverse(array_column($this->posts, 'id'));
        $posts = VkPost::where('owner_id', $post['owner_id'])
            ->whereNotIn('id', $ids)
            ->whereBetween('id', [current($ids), end($ids)])
            ->get();
        foreach ($posts as $post) {
            $post->delete();
        }
    }
}
