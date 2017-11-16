<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table ='article';
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Model\ArticleCat','cat_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment','artid');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User','uid');
    }
}
