<?php

namespace press\app\services\categories;

use \Exception;
use press\app\models\Categorie;

class CategorieService{

    /**
     * Méthode permettant de créer une nouvelle categorie via un tableau de données donné
     * @param array $data
     * @return Categorie categorie
     * @throws CategoryAlreadyExistsException
     */
    function createCategory(array $data): string{
        $categorie = new Categorie;
        $categorie->id = $data['id'];
        $categorie->titre = $data['titre'];
        $categorie->description = $data['description'];
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
     * @throws Exception
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
            //TODO : modifier exception
            throw new Exception( "L'id de la catégorie n'est pas renseigné");
        }
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
            //TODO : modifier exception
            throw new Exception("L'id de la catégorie n'est pas renseigné");
        }
    }
}