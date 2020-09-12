<?php
namespace App\Console\Commands\Vk;

use Illuminate\Console\Command;

use VK\Client\VKApiClient;
use App\VkUser;
use App\VkGroup;
use App\VkPost;

class GetPosts extends Command
{
    protected $id;
    protected $profiles;
    protected $groups;
    protected $posts;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-posts {id} {--group} {--count=20} {--offset=0}';

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
        $this->id = $this->option('group') ? '-'. $id : $id;

        // Получаем записи со служебной информацией
        $vk = new VKApiClient();
        $response = $vk->wall()->get(env('VK_SERVICE_KEY_'. rand (1, 2)), [
            'lang' => 'ru',
            'owner_id'  => $this->id,
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
            VkUser::create($this->profiles[$key]);
        }

        // Добавление отсутсвующих зависимостей(группы)
        $groupIds = array_column($this->groups, 'id');
        $groups = VkGroup::whereIn('id', $groupIds)->get();
        $ids = array_diff($groupIds , $groups->modelKeys());
        foreach ($ids as $key => $id) {
            VkGroup::create($this->groups[$key]);
        }

        // Добавление или обновление постов
        foreach($this->posts as $data) {
            // Очистка постоянно меняющихся полей у видеовложений
            if (isset($data['attachments'])) {
                $types = array_column($data['attachments'], 'type');
                if (false !== ($key = array_search('video', $types))) {
                    unset($data['attachments'][$key]['video']['track_code']);
                }
            }
            VkPost::updateOrCreate(['uuid' => $this->id .'_'. $data['id']], $data);
        }

        // Удаление отсуствующих постов
        $ids = array_reverse(array_column($this->posts, 'id'));
        $posts = VkPost::where('owner_id', $this->id)
            ->whereNotIn('id', $ids)
            ->whereBetween('id', [current($ids), end($ids)])
            ->get();
        foreach ($posts as $post) {
            $post->delete();
        }
    }
}
