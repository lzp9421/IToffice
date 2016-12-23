<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['name', 'quantity', 'picture', 'description'];

    public function Details()
    {
        return $this->hasMany('App\Model\Detail');
    }

    protected function getStatusAttribute($value)
    {
        switch ($value) {
            case 1: return '未借出';
            case 2: return '待归还';
            default: return '未知';
        }
    }
}
