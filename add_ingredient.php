<?php
/*********** CHARGEMENT DES LIBRAIRES ************** */
require_once 'lib/debug.php';

/*********** CHARGEMENT DU MODÈLE ************** */
require_once 'model/database.php';
require_once 'model/ingredients.php';

/*********** COEUR DU CONTROLEUR ************** */
$message     = '';
$messageType = 'danger';

// RECEPTION DU FORM
if(isset($_POST['name'])){

    $name = $_POST['name'];

    $success = addIngredient($name);

    if($success){
        $messageType = 'success';
        $message = 'Votre ingredient <strong>'. $name . '</strong> a bien été enregistré.';
    } else {
        $messageType = 'danger';
        $message = 'Erreur inconnue lors de l\'ajout de l\'ingrédient en base de donnée ';
    }

}

/*********** CHARGEMENT DE LA VUE ************** */
require_once 'vues/add_ingredient.phtml';