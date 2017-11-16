<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'comment';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo('App\Model\User','uid');
    }
}
