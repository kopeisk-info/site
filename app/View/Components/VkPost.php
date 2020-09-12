<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Artisan;

use App\VkPost as Post;
use App\VkGroup;
use App\VkUser;

class VkPost extends Component
{
    public $owner_id, $owner_name, $owner_screen_name, $owner_photo, $owner_link,
        $from_id, $from_name, $from_screen_name, $from_photo, $from_link,
        $post_id, $post_type, $post_link,
        $date, $text, $image, $action,
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
        if (!is_object($post->from)) {
            $post = $this->fresh($post);
        }

        $this->owner_id = $post->owner->id;
        $this->owner_name = $post->owner->name;
        $this->owner_screen_name = $post->owner->screen_name;
        $this->owner_photo = $post->owner->photo_50;
        $this->owner_link = "https://vk.com/{$this->owner_screen_name}";

        if ($post->owner->id !== $post->from->id) {
            $this->from_id = $post->from->id;
            $this->from_name = $post->from->name;
            $this->from_screen_name = $post->from->screen_name;
            $this->from_photo = $post->from->photo_50;
            $this->from_link = "https://vk.com/{$this->from_screen_name}";
            $this->action = $post->from->sex > 1 ? ' написал' : 'написалa';
        }

        $this->post_id = $post->id;
        $this->post_type = $post->post_type;
        $this->date = $post->date;
        $this->text = $post->text;

        $this->post_link = "{$this->owner_link}?w=wall{$post->uuid}";

        if ($post->attachments) {
            $attachment = current($post->attachments);
            if ('photo' === $attachment['type']) {
                if (($count = count($post->attachments)) > 1) {
                    $this->action = $count .' '. trans_choice('вложение|вложения|вложений', $count);
                }
                if ($url = $this->getImageUrl($attachment['photo']['sizes'])) {
                    $this->image = $url;
                }
            } elseif ('video' === $attachment['type']) {
                $this->action = 'видео';
                if ($url = $this->getImageUrl($attachment['video']['image'])) {
                    $this->image = $url;
                }
            } elseif (('link' === $attachment['type']) && isset($attachment['link']['photo'])) {
                $this->action = 'ссылка';
                if ($url = $this->getImageUrl($attachment['link']['photo']['sizes'])) {
                    $this->image = $url;
                }
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
            $repost = new Post($post->copy_history[0]);
            $this->repost = new self($repost);
        }
    }

    private function fresh($post)
    {
        $id = $post->getOriginal('from_id');
        if (preg_match('/^\d+$/', $id)) {
            // User
            if (! VkUser::find($id)) {
                Artisan::call('vk:get-users', [
                    'ids' => $id,
                    '--copy' => true
                ]);
            }
        } else {
            // Group
            $id = trim($id, '-');
            if (! VkGroup::find($id)) {
                Artisan::call('vk:get-groups', [
                    'ids' => $id,
                    '--copy' => true
                ]);
            }
        }

       return $post->fresh();
    }

    private function getImageUrl($sizes) {
        $sizes = array_filter($sizes, function($val) {
            if ((isset($val['type']) && in_array($val['type'], ['l', 'x', 'y', 'z'])) || $val['width'] >= 320) {
                return true;
            }
        });
        $sizes = array_merge(array_filter($sizes, function($val) {
            if (!isset($val['with_padding'])) {
                return true;
            }
        }), $sizes);

        if ($size = current($sizes)) {
            return $size['url'];
        }

        return false;
    }
}
