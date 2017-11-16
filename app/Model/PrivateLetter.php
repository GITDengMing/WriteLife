<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PrivateLetter extends Model
{
    protected $table ='private_letter';
    public $timestamps = false;
    //发送者
    public function send_user()
    {
        return $this->belongsTo('App\Model\User','from');
    }
    //接收者
    public function receive_user()
    {
        return $this->belongsTo('App\Model\User','to');
    }
}
