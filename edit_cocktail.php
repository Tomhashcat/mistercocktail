<?php
/*********** CHARGEMENT DES LIBRAIRES ************** */
require_once 'lib/debug.php';
require_once 'lib/routing.php';

/*********** CHARGEMENT DU MODÈLE ************** */
require_once 'model/database.php';
require_once 'model/cocktails.php';
require_once 'model/families.php';

/*********** COEUR DU CONTROLEUR ************** */
$message     = '';
$messageType = 'danger';
const DESTINATION_DIR = "images/cocktails/";

// RECEPTION DU FORM
if(isset($_POST['id'])){

    // RÉCUPÉRATION DE L'ID
    $id = $_POST['id'];

    // RÉCUPÉRATION DU NAME
    if(isset($_POST['name'])) {
        $name = $_POST['name'];
    }

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

    // // RÉCUPÉRATION DE L'IMAGE
    // if(isset($_FILES['image'])) {

    //     // RÉCUPÉRATION DU NOM TEMPORAIRE
    //     $from = $_FILES['image']['tmp_name'];
    
    //     // CALCUL DU NOM DE FICHIER DE DESTINATION
    //     $to = DESTINATION_DIR . $_FILES['image']['name'];
    
    //     // TENTATIVE DE DÉPLACEMENT DU FICHIER UPLOADÉ
    //     $success = move_uploaded_file ($from, $to);
    
    //     // MESSAGE SELON RÉUSSITE OU ÉCHEC
    //     if ($success) {
    //         $image = $_FILES['image']['name'];
    //         $message = 'Le fichier <strong>'.$_FILES['image']['name'].'</strong> a bien été uploadé.';
    //     } else {
    //         $image = '';
    //         $message = 'Une erreur s\'est produite lors de l\'envoi du fichier <strong>'.$_FILES['image']['name'].'</strong>.';
    //     }
    // }

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
    $success = updateCocktail($id, $name, $id_family, $description, '', $price, $year);

    // GESTION DU MESSAGE DE CONFIRMATION
    if($success){
        $messageType = 'success';
        $message = 'Votre cocktail <strong>'. $name . '</strong> a bien été enregistré.';
    } else {
        $messageType = 'danger';
        $message = 'Erreur inconnue lors de l\'ajout du cocktail en base de donnée ';
    }
} else {

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

    $id          = $cocktail['id'];
    $name        = $cocktail['name'];
    $id_family   = $cocktail['id_family'];
    $description = $cocktail['description'];
    $price       = $cocktail['price'];
    $year        = $cocktail['year'];

}

// CHARGE LA LISTE DES FAMILLES
$families = getAllFamilies();

/*********** CHARGEMENT DE LA VUE ************** */
require_once 'vues/edit_cocktail.phtml';

