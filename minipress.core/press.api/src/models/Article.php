<?php

namespace press\api\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    public $incrementing = false;
    public $keyType = 'string';
    public $timestamps = false;
    public $fillable = ['id', 'titre', 'date_creation', 'auteur', 'resume', 'contenu', 'date_publication', 'image', 'idCateg'];
    protected $table = 'article';
    protected $primaryKey = 'id';

    function categories(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'idCateg');
    }
}