<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'minister_id', 'prayer',
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

    public function minister()
    {
        return $this->belongsTo('App\Minister');
    }
}
