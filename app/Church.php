<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'scope',
        'name', 'full_name', 'description',
        'city', 'district',
        'foundation_date', 'registration_date',
        'main_site', 'contact_phone',
        'parent_id'
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
        'foundation_date' => 'datetime',
        'registration_date' => 'datetime',
    ];

    public function ministers()
    {
        return $this->belongsToMany('App\Minister', 'church_ministers');
    }

    public function vkGroups()
    {
        return $this->belongsToMany('App\VkGroup', 'church_vk_groups', 'church_id', 'group_id');
    }
}
