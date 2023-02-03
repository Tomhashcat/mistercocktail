<?php
require_once 'model/database.php';

/**
 * Renvoie tous les cocktails de la base de donnée
 *
 * @return array Tableau à deux dimensions contenants tous les cocktails
 */
function getAllCocktails(): array {
    $database = databaseConnect();

    $SQL = 'SELECT `cocktails`.`id`, `cocktails`.`name` , `description`, `image`, `price`, `year`, `families`.`name` AS `family_name`
            FROM `cocktails` 
            JOIN `families` ON `cocktails`.`id_family` = `families`.`id`
            WHERE active=1;';

    $query = $database->prepare($SQL);

    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Renvoie un cocktail à partir de son id
 *
 * @param integer $id Identifiant en base de donnée du cocktail
 * @return array Tableau associatif contenant toutes les données du cocktail
 */
function getCocktailById(int $id): array {
    $database = databaseConnect();

    $SQL = "SELECT `cocktails`.`id`, `cocktails`.`name` , `description`, `image`, `price`, `year`, `id_family`, `families`.`name` AS `family_name`
            FROM cocktails 
            JOIN `families` ON `cocktails`.`id_family` = `families`.`id`
            WHERE `cocktails`.`id` = :id";

    $query = $database->prepare($SQL);

    $query->execute([':id' => $id]);

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result)
        return $result;
    else
        return [];
}

/**
 * Enregistre un cocktail en BDD
 *
 * @param string $name Nom du cocktail
 * @param integer $id_family Id de la famille de cocktails
 * @param string $description Description du cocktail
 * @param string $image Nom du fichier .jpg
 * @param float $price Prix moyen constaté
 * @param integer $year Année de création
 * @return boolean True si tout s'est bien passé, sinon, false
 */
function addCocktail(string $name, int $id_family, string $description, string $image, float $price, int $year): bool{
    $database = databaseConnect();

    $SQL = "INSERT INTO `cocktails` 
                        (`id`, `name`, `id_family`, `description`, `image`, `price`, `year`) 
                 VALUES (null, :name, :id_family, :description, :image, :price, :year)";

    echo $SQL;

    $query = $database->prepare($SQL);

    $query->execute([
        ':name'         => $name,
        ':id_family'    => $id_family,
        ':description'  => $description,
        ':image'        => $image,
        ':price'        => $price,
        ':year'         => $year,
    ]);

    $id = $database->lastInsertId();

    return $id;
}

/**
 * Modifie le cocktail désigné en BDD
 *
 * @param integer $id id du cocktail à modifier
 * @param string $name Nom du cocktail
 * @param integer $id_family Id de la famille de cocktails
 * @param string $description Description du cocktail
 * @param string $image Nom du fichier .jpg
 * @param float $price Prix moyen constaté
 * @param integer $year Année de création
 * @return boolean True si tout s'est bien passé, sinon, false
 */
function updateCocktail (int $id, string $name, int $id_family, string $description, string $image, float $price, int $year): bool{
    $database = databaseConnect();

    $SQL = "UPDATE `cocktails` 
            SET `name` = :name,
                `id_family` = :id_family,
                `description` = :description,
                `price` = :price,
                `year` = :year
            WHERE `cocktails`.`id` = :id;";

    $query = $database->prepare($SQL);

    $query->execute([
        ':id'           => $id,
        ':name'         => $name,
        ':id_family'    => $id_family,
        ':description'  => $description,
        // ':image'        => $image,
        ':price'        => $price,
        ':year'         => $year,
    ]);
   
    return true;
}

/**
 * Supprime un cocktail de la base de données
 *
 * @param integer $id Id du cocktail à supprimer
 * @return void
 */
function deleteCocktail(int $id){
    $database = databaseConnect();

    $SQL = "DELETE FROM cocktails WHERE `cocktails`.`id` = :id";

    $query = $database->prepare($SQL);

    $query->execute([':id' => $id]);
}