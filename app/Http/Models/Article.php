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
    // public $timestamps = false;

    protected $fillable =[
        'user_id','title','content','images'
    ];

    // 一對一
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
