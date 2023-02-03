<?php
/*********** CHARGEMENT DES LIBRAIRES ************** */
require_once 'lib/debug.php';

/*********** CHARGEMENT DU MODÈLE ************** */
require_once 'model/database.php';
require_once 'model/cocktails.php';
require_once 'model/families.php';

/*********** COEUR DU CONTROLEUR ************** */
$message     = '';
$messageType = 'danger';
const DESTINATION_DIR = "images/cocktails/";

// RECEPTION DU FORM
if(isset($_POST['name'])){
    
    // RÉCUPÉRATION DU NAME
    $name = $_POST['name'];

    // RÉCUPÉRATION DE ID_FAMILY
    $id_family = 1;
    if(isset($_POST['id_family'])) {
        $id_family = $_POST['id_family'];
    }

    // RÉCUPÉRATION DE LA DESCRIPTION
    $description = "";
    if(isset($_POST['description'])) {
        $description = $_POST['description'];
    }    

    // RÉCUPÉRATION DE L'IMAGE
    if(isset($_FILES['image'])) {

        // RÉCUPÉRATION DU NOM TEMPORAIRE
        $from = $_FILES['image']['tmp_name'];
    
        // CALCUL DU NOM DE FICHIER DE DESTINATION
        $to = DESTINATION_DIR . $_FILES['image']['name'];
    
        // TENTATIVE DE DÉPLACEMENT DU FICHIER UPLOADÉ
        $success = move_uploaded_file ($from, $to);
    
        // MESSAGE SELON RÉUSSITE OU ÉCHEC
        if ($success) {
            $image = $_FILES['image']['name'];
            $message = 'Le fichier <strong>'.$_FILES['image']['name'].'</strong> a bien été uploadé.';
        } else {
            $image = '';
            $message = 'Une erreur s\'est produite lors de l\'envoi du fichier <strong>'.$_FILES['image']['name'].'</strong>.';
        }
    }

    // RÉCUPÉRATION DE L'ANNEE
    $year = 1900;
    if(isset($_POST['year'])) {
        $year = $_POST['year'];
    }   
    
    // RÉCUPÉRATION DU PRIX
    $price = 9.99;
    if(isset($_POST['price'])) {
        $price = $_POST['price'];
    }       

    // TENTATIVE D'ENREGISTREMENT EN BDD
    $success = addCocktail($name, $id_family, $description, $image, $price, $year);

    // GESTION DU MESSAGE DE CONFIRMATION
    if($success){
        $messageType = 'success';
        $message = 'Votre cocktail <strong>'. $name . '</strong> a bien été enregistré.';
    } else {
        $messageType = 'danger';
        $message = 'Erreur inconnue lors de l\'ajout du cocktail en base de donnée ';
    }
}

// CHARGE LA LISTE DES FAMILLES
$families = getAllFamilies();

/*********** CHARGEMENT DE LA VUE ************** */
require_once 'vues/add_cocktail.phtml';

