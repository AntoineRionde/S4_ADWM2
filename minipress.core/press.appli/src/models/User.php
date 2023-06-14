<?php

namespace press\app\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}