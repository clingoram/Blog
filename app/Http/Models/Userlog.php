<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userlog extends Model
{
    protected $table = 'userlogs';
    // primary key
    public $primaryKey = 'id';

    protected $fillable = [
        'member_id','note'
    ];
}
