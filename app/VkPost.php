<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class VkPost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'from_id', 'owner_id',
        'date', 'marked_as_ads', 'post_type',
        'text', 'copy_history', 'post_source',
        'comments', 'likes', 'reposts', 'views'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // ...
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime',
        'copy_history' => 'array',
        'post_source' => 'array',
        'comments' => 'array',
        'likes' => 'array',
        'reposts' => 'array',
        'views' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            if (!empty($model->copy_history)) {
                foreach ($model->copy_history as $item) {
                    $id = $item['from_id'];
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
                }
            }
        });

        static::updating(function($model) {
            if (!empty($model->copy_history)) {
                foreach ($model->copy_history as $item) {
                    $id = $item['from_id'];
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
                }
            }
        });
    }
}
