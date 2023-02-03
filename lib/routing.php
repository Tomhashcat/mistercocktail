<?php

$routes = [
    'accueil'           => 'index.php',
    'admin'             => 'back_office.php',
    'çocktail/add'      => 'add_cocktail.php',
    'çocktail/edit'     => 'edit_cocktail.php',
    'çocktail/delete'   => 'delete_cocktail.php',
    '404'               => '404.php',
    '403'               => '403.php',
];

/**
 * Lance une redirection vers l'url fournie
 *
 * @param string $url Destination vers laquelle se fera la redirection
 * @return void
 */
function redirect(string $url){
    header('Location: ' . $url);
    die();
}

/**
 * Lance une redirection vers la route fournie
 *
 * @param string $route Route de destination  vers laquelle se fera la redirection
 * @return void
 */
function redirectRoute(string $route){
    global $routes;

    if (isset($routes[$route])) {
        header('Location: ' . $routes[$route]);
        die();
    }
}