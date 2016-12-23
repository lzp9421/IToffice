<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classification extends Model
{
    use SoftDeletes;
    //

    public function Reports()
    {
        return $this->hasMany('App\Model\Report');
    }
}
