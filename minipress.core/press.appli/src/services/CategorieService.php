<?php

<<<<<<< HEAD
namespace gift\app\services\categorie;

use gift\app\models\Prestation;
use gift\app\models\Categorie;
=======
namespace press\app\services;

use PHPUnit\Exception;
use press\app\models\Categorie;
>>>>>>> 112952990148bee9538291d24689b86696de069d
use Slim\Exception\HttpBadRequestException;

class CategorieService{


<<<<<<< HEAD
    /**
     * Récupère toutes les catégories existantes.
     *
     * @return array
     */
    function getCategories()
    {
=======
    function getCategories(){
>>>>>>> 112952990148bee9538291d24689b86696de069d
        $categories = Categorie::all();
        return $categories;
    }

<<<<<<< HEAD
    /**
     * Récupère une catégorie spécifique en fonction de son identifiant.
     *
     * @param int $id L'identifiant de la catégorie
     * @return array
     * @throws HttpBadRequestException Si l'id de la catégorie n'est pas renseigné
     */
    function getCategorieById(int $id)
    {
        try {
            return Categorie::findOrFail($id)->toArray();
        } catch (Exception $e) {
            throw new HttpBadRequestException($request, "L'id de la catégorie n'est pas renseigné");
        }
    }

    /**
     * Crée une nouvelle catégorie avec les données fournies.
     *
     * @param array $data Les données de la catégorie (titre et description)
     * @return array
     */
    function createCategorie(array $data)
    {
=======
    function getCategorieById(int $id){
        try {
            return Categorie::findOrFail($id)->toArray();
        }catch(Exception $e) {
            throw new HttpBadRequestException( "L'id de la catégorie n'est pas renseigné");
        }
    }

    function createCategorie(array $data){
>>>>>>> 112952990148bee9538291d24689b86696de069d
        $categorie = new Categorie();
        $categorie->libelle = $data['titre'];
        $categorie->description = $data['description'];
        $categorie->save();
        return $categorie->toArray();
    }

<<<<<<< HEAD
    /**
     * Supprime une catégorie spécifique en fonction de son identifiant.
     *
     * @param int $idCat L'identifiant de la catégorie à supprimer
     * @return array
     * @throws HttpBadRequestException Si l'id de la catégorie n'est pas renseigné
     */
    function deleteCategorie($idCat)
    {
=======
    function deleteCategorie($idCat){
>>>>>>> 112952990148bee9538291d24689b86696de069d
        try {
            $categorie = Categorie::findOrFail($idCat);
            $categorie->delete();
            return $categorie->toArray();
<<<<<<< HEAD
        } catch (Exception $e) {
            throw new HttpBadRequestException($request, "L'id de la catégorie n'est pas renseigné");
        }
    }
}
=======
        }catch(Exception $e) {
            throw new HttpBadRequestException("L'id de la catégorie n'est pas renseigné");
        }
    }
}
>>>>>>> 112952990148bee9538291d24689b86696de069d
