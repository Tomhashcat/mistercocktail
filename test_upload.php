<?php
/*********** CHARGEMENT DES LIBRAIRES ************** */
require_once 'lib/debug.php';

/*********** CHARGEMENT DU MODÈLE ************** */
require_once 'model/database.php';
require_once 'model/cocktails.php';

/*********** COEUR DU CONTROLEUR ************** */
const DESTINATION_DIR = "images/cocktails/";
$message     = '';
$messageType = 'danger';

// EST-CE QU'ON A REÇU UN FICHIER PAR UPLAOD ?
if(isset($_FILES['image'])) {

    // RÉCUPÉRATION DU NOM TEMPORAIRE
    $from = $_FILES['image']['tmp_name'];

    // CALCUL DU NOM DE FICHIER DE DESTINATION
    $to = DESTINATION_DIR . $_FILES['image']['name'];

    // TENTATIVE DE DÉPLACEMENT DU FICHIER UPLOADÉ
    $success = move_uploaded_file ($from, $to);

    // MESSAGE SELON RÉUSSITE OU ÉCHEC
    if ($success) {
        $message = 'Le fichier <strong>'.$_FILES['image']['name'].'</strong> a bien été uploadé.';
    } else {
        $message = 'Une erreur s\'est produite lors de l\'envoi du fichier <strong>'.$_FILES['image']['name'].'</strong>.';
    }
}

/*********** CHARGEMENT DE LA VUE ************** */
require_once 'vues/test_upload.phtml';

