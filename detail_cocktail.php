<?php
/*********** CHARGEMENT DES LIBRAIRES ************** */
require_once 'lib/debug.php';
require_once 'lib/routing.php';

/*********** CHARGEMENT DU MODÈLE ************** */
require_once 'model/database.php';
require_once 'model/cocktails.php';
require_once 'model/ingredients.php';

/*********** COEUR DU CONTROLEUR ************** */

// SI ON A PAS REÇU D'ID => REDIRECTION
if(!isset($_GET['id'])) { redirect('index.php'); }

// RÉCUPÉRATION DE L'ID
$id = $_GET['id']; 

// CONVERTION EN INT
$id = intval ($id); 

// SI L'ID N'EST PAS NUMÉRIQUE => REDIRECTION
if(!$id){ redirect('index.php'); }

// RÉCUPÉRATION DU COCKTAIL
$cocktail = getCocktailById($id);

// SI LE COCKTAIL N'EXISTE EN BDD => REDIRECTION
if (empty($cocktail)) { redirect('index.php'); }

// RÉCUPÈRE LA LISTE DES INGRÉDIENTS
$ingredients = getIngredientsByCocktailId($id);

/*********** CHARGEMENT DE LA VUE ************** */
require_once 'vues/detail_cocktail.phtml';

