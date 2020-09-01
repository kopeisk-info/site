<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Artisan;

class VkPost extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'from_id', 'owner_id',
        'date', 'marked_as_ads', 'post_type',
        'text', 'attachments', 'copy_history', 'post_source',
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
        'attachments' => 'array',
        'copy_history' => 'collection',
        'post_source' => 'array',
        'comments' => 'array',
        'likes' => 'array',
        'reposts' => 'array',
        'views' => 'array',
    ];

    public function getTextAttribute($value)
    {
        if (preg_match('/\[(.*)\|(.*)\]/', $value, $matches)) {
            $replace = "<a href='https://vk.com/id$matches[1]' title='$matches[2]'>$matches[2]</a>";
            $value = str_replace($matches[0], $matches[2] , $value);
        }
        return $value;
    }

    public function from()
    {
        $relation = $this->hasOne('App\VkUser', 'user_id', 'from_id');
        if (!preg_match('/^\d+$/', $this->from_id)) {
            $relation = $this->hasOne('App\VkGroup', 'group_id', 'from_id');
        }
        return $relation;
    }

    public function owner()
    {
        $relation = $this->hasOne('App\VkUser', 'user_id', 'owner_id');
        if (!preg_match('/^\d+$/', $this->owner_id)) {
            $relation = $this->hasOne('App\VkGroup', 'group_id', 'owner_id');
        }
        return $relation;
    }

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
                        if (! VkGroup::find(abs($id))) {
                            Artisan::call('vk:get-groups', [
                                'ids' => abs($id),
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
                        if (! VkGroup::find(abs($id))) {
                            Artisan::call('vk:get-groups', [
                                'ids' => abs($id),
                                '--copy' => true
                            ]);
                        }
                    }
                }
            }
        });
    }
}
