<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChurchMinister extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'church_id', 'minister_id', 'ordination'
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

    public function church()
    {
        return $this->belongsTo('App\Church');
    }

    public function minister()
    {
        return $this->belongsTo('App\Minister');
    }
}
