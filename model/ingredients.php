<?php
require_once 'model/database.php';

/**
 * Renvoie la liste de tous les ingrédients
 *
 * @return array Tableau à deux dimensions contenant tous les ingrédients
 */
function getAllIngredients(): array {
    $database = databaseConnect();

    $SQL = 'SELECT * FROM `ingredients`';

    $query = $database->prepare($SQL);

    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Renvoie tous les ingrédients d'un cocktail
 *
 * @param integer $id Id du coktail
 * @return array Tableau à deux dimensions contenant tous les ingrédients
 */
function getIngredientsByCocktailId(int $id): array{
    $database = databaseConnect();

    $SQL = 'SELECT `ingredients`.`id`, name
            FROM `cocktails_ingredients` 
            JOIN `ingredients` ON `cocktails_ingredients`.`id_ingredient` = `ingredients`.`id`
            WHERE `id_cocktail` = :id;';

    $query = $database->prepare($SQL);

    $query->execute([':id' => $id]);

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Ajoute un ingrédient dans la BDD
 *
 * @param string $name Nom de l'ingrédient
 * @return boolean true si tout s'est bien passé
 */
function addIngredient(string $name): bool {

    $database = databaseConnect();

    $SQL = "INSERT INTO `ingredients` 
                        (`id`, `name`) 
                 VALUES (null, :name)";

    $query = $database->prepare($SQL);

    $query->execute([
        ':name'         => $name
    ]);

    $id = $database->lastInsertId();

    return $id;
}

/**
 * Ajoute dans la table cocktails_ingredients une nouvelle relation entre un cocktail et un ingrédient
 *
 * @param integer $id_cocktail Id du cocktail
 * @param integer $id_ingredient Id de l'ingrédient
 * @return boolean true si tout s'est bien passé
 */
function addRelationCocktailToIngredient(int $id_cocktail, int $id_ingredient): bool{

    $database = databaseConnect();

    $SQL = "INSERT INTO `cocktails_ingredients` (`id_cocktail`, `id_ingredient`) VALUES (:id_cocktail, :id_ingredient);";

    $query = $database->prepare($SQL);

    $query->execute([
        ':id_cocktail'    => $id_cocktail,
        ':id_ingredient'  => $id_ingredient,
    ]);

    return true;
}

/**
 * Supprime toutes les associations entre un cocktail et ses ingrédients
 *
 * @param integer $id Id du cocktail
 * @return void
 */
function deleteAllIngredientsOfCocktail(int $id){

    $database = databaseConnect();

    $SQL = "DELETE FROM `cocktails_ingredients` WHERE `id_cocktail` = :id";

    $query = $database->prepare($SQL);

    $query->execute([
        ':id'    => $id,
    ]);

    return true;
}
