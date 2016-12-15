<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    //

    public function Reports()
    {
        return $this->hasMany('App\Model\Report');
    }
}
