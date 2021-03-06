<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VkUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name',
        'is_closed', 'can_access_closed', 'can_see_all_posts', 'from_copy',
        'sex', 'screen_name',
        'photo_50'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
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

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model) {
            $model->user_id = abs($model->id);
        });

        static::updating(function($model) {
            $model->user_id = abs($model->id);
        });
    }
}
