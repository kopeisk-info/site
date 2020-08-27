<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\VkPost as Post;

class VkPost extends Component
{
    public $id, $name, $screen_name, $photo,
        $post_id, $post_type,
        $date, $text, $image,
        $action, $from_link, $post_link,
        $comments, $likes, $reposts = 0, $views = 0;

    public $repost;

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

        $this->post_id = $post->id;
        $this->post_type = $post->post_type;
        $this->date = $post->date;
        $this->text = $post->text;

        $this->from_link = "https://vk.com/{$this->screen_name}";
        $this->post_link = "{$this->from_link}?w=wall-{$this->id }_{$this->post_id}";

        if ($post->attachments) {
            $attachment = current($post->attachments);
            if ('photo' === $attachment['type']) {
                $key = array_search('x', array_column($attachment['photo']['sizes'], 'type'));
                $this->image = $attachment['photo']['sizes'][$key]['url'];
            } elseif ('video' === $attachment['type']) {
                $key = array_search('x', array_column($attachment['video']['image'], 'type'));
                $this->image = $attachment['video']['image'][$key]['url'];
            } elseif (('link' === $attachment['type']) && isset($attachment['link']['photo'])) {
                $this->action = 'ссылка';
                $key = array_search('x', array_column($attachment['link']['photo']['sizes'], 'type'));
                $this->image = $attachment['link']['photo']['sizes'][$key]['url'];
            }
        }

        if ($post->comments && $post->comments['can_post']) {
            $this->comments = $post->comments['count'];
        }
        if ($post->likes && $post->likes['can_like']) {
            $this->likes = $post->likes['count'];
        }
        if ($post->reposts && $post->reposts['count']) {
            $this->reposts = $post->reposts['count'];
        }
        if ($post->views && $post->views['count']) {
            $this->views = $post->views['count'];
        }

        if ($post->copy_history) {
            $this->action = 'репост';
            $post = Post::make($post->copy_history->get(0));
            $this->repost = new self($post);
        }
    }
}
