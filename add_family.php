<?php
/*********** CHARGEMENT DES LIBRAIRES ************** */
require_once 'lib/debug.php';

/*********** CHARGEMENT DU MODÈLE ************** */
require_once 'model/database.php';
require_once 'model/families.php';

/*********** COEUR DU CONTROLEUR ************** */
$message     = '';
$messageType = 'danger';

// RECEPTION DU FORM
if(isset($_POST['name'])){

    $name = $_POST['name'];

    $success = addFamily($name);

    if($success){
        $messageType = 'success';
        $message = 'Votre famille de cocktails <strong>'. $name . '</strong> a bien été enregistrée.';
    } else {
        $messageType = 'danger';
        $message = 'Erreur inconnue lors de l\'ajout de la famille de cocktails en base de donnée ';
    }

}
/*********** CHARGEMENT DE LA VUE ************** */
require_once 'vues/add_family.phtml';