<?php

namespace press\app\services;

use press\app\models\Categorie;
use Slim\Exception\HttpBadRequestException;

class CategorieService{


    function getCategories(){
        $categories = Categorie::all();
        return $categories;
    }

    function getCategorieById(int $id){
        try {
            return Categorie::findOrFail($id)->toArray();
        }catch(ModelNotFoundException $e) {
            throw new HttpBadRequestException($request, "L'id de la catégorie n'est pas renseigné");
        }
    }

    function createCategorie(array $data){
        $categorie = new Categorie();
        $categorie->libelle = $data['titre'];
        $categorie->description = $data['description'];
        $categorie->save();
        return $categorie->toArray();
    }

    function deleteCategorie($idCat){
        try {
            $categorie = Categorie::findOrFail($idCat);
            $categorie->delete();
            return $categorie->toArray();
        }catch(ModelNotFoundException $e) {
            throw new HttpBadRequestException($request, "L'id de la catégorie n'est pas renseigné");
        }
    }
}