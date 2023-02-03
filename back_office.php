<?php
/*********** CHARGEMENT DES LIBRAIRES ************** */
require_once 'lib/debug.php';

/*********** CHARGEMENT DU MODÈLE ************** */
require_once 'model/database.php';
require_once 'model/cocktails.php';

/*********** COEUR DU CONTROLEUR ************** */

$cocktails = getAllCocktails();


/*********** CHARGEMENT DE LA VUE ************** */
require_once 'vues/back_office.phtml';

