<?php

namespace press\app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model{
    protected $table = 'article';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;
    public $fillable = ['id', 'titre', 'date_creation', 'auteur', 'resume', 'contenu', 'date_publication', 'image', 'idCateg'];

    function categories(): BelongsTo{
        return $this->belongsTo(Categorie::class, 'idCateg');
    }
}