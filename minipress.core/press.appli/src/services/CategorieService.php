<?php

namespace gift\app\services\categorie;

use gift\app\models\Prestation;
use gift\app\models\Categorie;
use Slim\Exception\HttpBadRequestException;

class CategorieService{


    /**
     * Récupère toutes les catégories existantes.
     *
     * @return array
     */
    function getCategories()
    {
        $categories = Categorie::all();
        return $categories;
    }

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
        $categorie = new Categorie();
        $categorie->libelle = $data['titre'];
        $categorie->description = $data['description'];
        $categorie->save();
        return $categorie->toArray();
    }

    /**
     * Supprime une catégorie spécifique en fonction de son identifiant.
     *
     * @param int $idCat L'identifiant de la catégorie à supprimer
     * @return array
     * @throws HttpBadRequestException Si l'id de la catégorie n'est pas renseigné
     */
    function deleteCategorie($idCat)
    {
        try {
            $categorie = Categorie::findOrFail($idCat);
            $categorie->delete();
            return $categorie->toArray();
        } catch (Exception $e) {
            throw new HttpBadRequestException($request, "L'id de la catégorie n'est pas renseigné");
        }
    }
}
