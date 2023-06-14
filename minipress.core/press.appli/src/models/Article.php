<?php

namespace press\app\models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model{
    protected $table = 'article';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}