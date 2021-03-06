<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VkGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'screen_name',
        'is_closed', 'can_see_all_posts',
        'from_copy', 'type',
        'photo_50'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'group_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // ...
    ];

    public function scopeUpdateOlderThan($query, $interval)
    {
        return $query->where('updated_at', '<=', Carbon::now()->subMinutes($interval)->toDateTimeString());
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->group_id = '-'. abs($model->id);
        });

        static::updating(function($model) {
            $model->group_id = '-'. abs($model->id);
        });
    }
}
