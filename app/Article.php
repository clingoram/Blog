<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // table name
    protected $table = 'articles';
    // primary key
    public $primaryKey = 'id';
    // timestamps
    public $timestamps = false;

}
