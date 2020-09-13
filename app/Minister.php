<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minister extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'first_name', 'middle_name',
        'description',
        'city', 'district',
        'phone', 'email'
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
        // ...
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} ". ($this->middle_name ? $this->middle_name ." " : "") ."{$this->last_name}";
    }

    public function churchs()
    {
        return $this->belongsToMany('App\Minister', 'church_ministers');
    }

    public function ordination()
    {
        return $this->hasOne('App\ChurchMinister');
    }

    public function vkUsers()
    {
        return $this->belongsToMany('App\VkUser', 'minister_vk_users', 'minister_id', 'user_id');
    }

    public function vkGroups()
    {
        return $this->belongsToMany('App\VkGroup', 'minister_vk_groups', 'minister_id', 'group_id');
    }
}
