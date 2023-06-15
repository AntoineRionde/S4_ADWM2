<?php

namespace press\app\services;

use PHPUnit\Exception;
use press\app\models\Categorie;
use Slim\Exception\HttpBadRequestException;

class CategorieService{

    /**
     * Méthode permettant de récupérer toutes les catégories
     * @return array
     */
    function getCategories() : array {
        $categories = Categorie::all();
        return $categories->toArray();
    }

    /**
     * Méthode permettant de récupérer une catégorie par son id
     * @param int $id
     * @return array $categorie
     */
    function getCategorieById(int $id) : array {
        try {
            return Categorie::findOrFail($id)->toArray();
        }catch(Exception $e) {
            throw new HttpBadRequestException( "L'id de la catégorie n'est pas renseigné");
        }
    }

    /**
     * Méthode permettant de créer une catégorie
     * @param array $data
     * @return array $categorie
     */
    function createCategorie(array $data) : array {
        $categorie = new Categorie();
        $categorie->libelle = $data['titre'];
        $categorie->description = $data['description'];
        $categorie->save();
        return $categorie->toArray();
    }

    /**
     * Méthode permettant de supprimer une catégorie
     * @param $idCat id de la categorie a supprimer
     * @return array $categorie
     */
    function deleteCategorie($idCat) : array{
        try {
            $categorie = Categorie::findOrFail($idCat);
            $categorie->delete();
            return $categorie->toArray();
        }catch(Exception $e) {
            throw new HttpBadRequestException("L'id de la catégorie n'est pas renseigné");
        }
    }
}