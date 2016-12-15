<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = ['classification_id', 'address', 'description', 'remark', 'user_id'];

    public function Classification()
    {
        return $this->belongsTo('App\Model\Classification');
    }

    public function User()
    {
        return $this->belongsTo('App\Model\User');
    }
}
