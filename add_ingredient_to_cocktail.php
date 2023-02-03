<?php
/*********** CHARGEMENT DES LIBRAIRES ************** */
require_once 'lib/debug.php';
require_once 'lib/routing.php';

/*********** CHARGEMENT DU MODÈLE ************** */
require_once 'model/database.php';
require_once 'model/ingredients.php';

/*********** COEUR DU CONTROLEUR ************** */
$message     = '';
$messageType = 'danger';

// SI ON REÇOIT LE FORMULAIRE
if(isset($_POST['id'])){

    // RÉCUPÉRER L'ID
    $id = $_POST['id'];

    // RÉCUPÉRER LES INGRÉDIENTS
    if(isset($_POST['ingredients'])){
        $ingredients = $_POST['ingredients'];

        // VIDER TOUS LES INGREDIENTS DU COCKTAIL
        deleteAllIngredientsOfCocktail($id);
        
        // POUR CHAQUE INGREDIENT
        foreach($ingredients as $ingredient){

            // AJOUTE LA RELATION À LA BDD
            addRelationCocktailToIngredient($id, $ingredient);
        }

    }
    

} else {

    // SI ON A PAS REÇU D'ID => REDIRECTION
    if(!isset($_GET['id'])) { redirect('index.php'); }
    $id = $_GET['id'];
}

// CHARGE TOUS LES INGREDIENTS
$ingredients = getAllIngredients();

// CHARGE LES INGREDIENTS  DU COCKTAIL ACTUEL
$cocktailIngredients = getIngredientsByCocktailId($id);

// CONVERTI EN TABLEAU À 1 DIMENSION (AVEC UNIQUEMENT LES ID)
$cocktailIngredientsIds = [];
foreach($cocktailIngredients as $cocktailIngredient){
    $cocktailIngredientsIds[] = $cocktailIngredient['id'];
}

// RECEPTION DU FORM
// if(isset($_POST['name'])){

// }
/*********** CHARGEMENT DE LA VUE ************** */
require_once 'vues/add_ingredient_to_cocktail.phtml';