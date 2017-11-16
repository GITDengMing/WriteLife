<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table ='user';
    public $timestamps = false;
    //重要日子
    public function article()
    {
        return $this->hasMany('App\Model\Article','uid');
    }
    //日记
    public function diary()
    {
        return $this->hasMany('App\Model\diary','uid');
    }
    //重要日子
    public function imp_date()
    {
        return $this->hasMany('App\Model\ImportantDate','uid');
    }
    //相册（主动拥有）
    public function album()
    {
        return $this->hasMany('App\Model\Album','uid');
    }
    //关注的人(主动关注)
    public function followers()
    {
        return $this->belongsToMany('App\Model\User','follow','uid','followed_id');
    }
    //粉丝（被关注）
    public function fans()
    {
        return $this->belongsToMany('App\Model\User','follow','followed_id','uid');
    }
    //收到的私信（被发私信）
    public function privateLetter()
    {
        return $this->hasMany('App\Model\PrivateLetter','to');
    }

    public function fans_num()
    {
        return $this->fans()->count();
    }
}
