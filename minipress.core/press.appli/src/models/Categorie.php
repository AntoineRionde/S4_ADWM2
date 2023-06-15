<?php

namespace press\app\models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
}