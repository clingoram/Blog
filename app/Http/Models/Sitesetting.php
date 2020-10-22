<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitesetting extends Model
{
    protected $table = 'sitesettings'; // 資料表名稱

    public $primaryKey = 'id';   // 主鍵

    protected $fillable = [
        'site_status','member_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
