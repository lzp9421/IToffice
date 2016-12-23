<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['asset_id', 'direction', 'quantity', 'site', 'institutions', 'contact', 'remark'];

    public function Asset()
    {
        return $this->belongsTo('App\Model\Asset');
    }

    public function isIncrease()
    {
        switch ($this->getOriginal('direction')) {
            case 1:
            case 2:
            case 3: return true;//增加
            case 4:
            case 5:
            case 6: return false;
            default: return false;//减少
        }
    }

    protected function getDirectionAttribute($value)
    {
        //1新增|2增加|3归还||4借出|5使用|6报废
        switch ($value) {
            case 1: return '新增';
            case 2: return '增加';
            case 3: return '归还';
            case 4: return '借出';
            case 5: return '使用';
            case 6: return '报废';
            default: return '';
        }
    }
}
