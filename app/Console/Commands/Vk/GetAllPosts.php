<?php
namespace App\Console\Commands\Vk;

class GetAllPosts extends GetPosts
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vk:get-all-posts {id} {--group} {--count=100} {--offset=0}';

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
        do {
            parent::handle();
            $offset = $this->option('count') + $this->option('offset');
            $this->getDefinition()->getOption('offset')->setDefault($offset);
        } while($this->posts);
    }
}
