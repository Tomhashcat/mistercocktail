<?php
require_once 'model/database.php';

/**
 * Renvoie toutes les familles de cocktails présentent en BDD
 *
 * @return array Tableau à 2 dimensions contenant les familles (id, name)
 */
function getAllFamilies(): array{
    $database = databaseConnect();

    $SQL = 'SELECT * FROM `families`';

    $query = $database->prepare($SQL);

    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


/**
 * Ajoute une familles de cocktail dans la BDD
 *
 * @param string $name Nom de la famille
 * @return boolean true si tout s'est bien passé
 */
function addFamily(string $name): bool {

    $database = databaseConnect();

    $SQL = "INSERT INTO `families` 
                        (`id`, `name`) 
                 VALUES (null, :name)";

    $query = $database->prepare($SQL);

    $query->execute([
        ':name'         => $name
    ]);

    $id = $database->lastInsertId();

    return $id;
}