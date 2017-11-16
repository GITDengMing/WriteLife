<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';
    public $timestamps = false;

    public function pictures()
    {
        return $this->hasMany('App\Model\Picture','abid');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User','uid');
    }
}
