<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitesetting extends Model
{
    protected $table = 'sitesettings';
    
    protected $fillable = [
        'account','site_status'
    ];
}