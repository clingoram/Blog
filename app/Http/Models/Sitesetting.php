<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitesetting extends Model
{
    protected $table = 'sitesettings'; // 資料表名稱
    protected $primaryKey = 'id';   // 主鍵
    
    protected $fillable = [
        'account','site_status','member_id'
    ];
}
