<?php

namespace press\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model{
    protected $table = 'article';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    function categories(): BelongsTo{
        return $this->belongsTo(Categorie::class, 'idCateg');
    }
}