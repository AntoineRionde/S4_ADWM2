<?php

namespace press\app\services\categories;

use \Exception;
use press\app\models\Categorie;

class CategorieService{

    /**
     * Méthode permettant de créer une nouvelle categorie via un tableau de données donné
     * @param array $donnee
     * @return Categorie categorie
     * @throws Exception
     */
    function create(array $donnee): string{
        $categorie = new Categorie;
        $categorie->id = $donnee['id'];
        $categorie->titre = $donnee['titre'];
        $categorie->description = $donnee['description'];
        if ($this->IsCategorieExist($categorie->titre))
            throw new CategoryAlreadyExistsException();
        $categorie->save();
        return $categorie;
    }

    /**
     * @param string $titre
     * @return bool
     * permet de tester une catégorie existe déjà dans la base
     * utile lors de la création d'une catégorie
     */
    public function IsCategorieExist(string $titre):bool
    {
        $titre = Categorie::where('titre', $titre)->first();
        return (bool)$titre;
    }

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
     * @throws Exception
     */
    function getCategorieById(int $id) : array {
        try {
            return Categorie::findOrFail($id)->toArray();
        }catch(Exception $e) {
            throw new Exception( "L'id de la catégorie n'est pas renseigné");
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
     * @param $idCat
     * @return array
     * @throws Exception
     */
    function deleteCategorie($idCat) : array{
        try {
            $categorie = Categorie::findOrFail($idCat);
            $categorie->delete();
            return $categorie->toArray();
        }catch(Exception $e) {
            throw new Exception("L'id de la catégorie n'est pas renseigné");
        }
    }
}