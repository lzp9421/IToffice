<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['classification_id', 'address', 'description', 'remark', 'user_id'];//白名单

    public function Classification()
    {
        return $this->belongsTo('App\Model\Classification');
    }

    public function User()
    {
        return $this->belongsTo('App\Model\User');
    }
}
