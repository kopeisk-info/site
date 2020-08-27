<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VkPost extends Component
{
    public $id, $name, $screen_name, $photo,
        $post_id, $post_type, $date, $text,
        $from_link, $post_link,
        $action;

    private $copy_history;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->preparing($post);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        return view('components.vk-post');
    }

    protected function preparing($post)
    {
        $this->id = $post->from->id;
        $this->name = $post->from->name;
        $this->screen_name = $post->from->screen_name;
        $this->photo = $post->from->photo_50;

        $this->post_id = $post->from->id;
        $this->post_type = $post->post_type;
        $this->date = $post->date;
        $this->text = $post->text;

        $this->from_link = "https://vk.com/{$this->screen_name}";
        $this->post_link = "{$this->from_link}?w=wall-{$this->id }_{$this->post_id}";

        $this->action = 'разместил пост';
        if ('post' == $this->post_type) {

        }

        if ($post->copy_history) {
            $this->copy_history = $post->copy_history;
        }
    }
}
