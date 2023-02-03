<?php
/*********** CHARGEMENT DES LIBRAIRES ************** */
require_once 'lib/debug.php';
require_once 'lib/routing.php';

/*********** CHARGEMENT DU MODÈLE ************** */
require_once 'model/database.php';
require_once 'model/cocktails.php';

/*********** COEUR DU CONTROLEUR ************** */

// SI ON A PAS REÇU D'ID => REDIRECTION
if(!isset($_GET['id'])) { redirect('index.php'); }

// RÉCUPÉRATION DE L'ID
$id = $_GET['id']; 

// CONVERTION EN INT
$id = intval ($id); 

// SI L'ID N'EST PAS NUMÉRIQUE => REDIRECTION
if(!$id){ redirect('index.php'); }

// SUPPRESSION DU COCKTAIL
deleteCocktail($id);

// RETOUR À LA PAGE D'ADMIN
redirect('back_office.php');



