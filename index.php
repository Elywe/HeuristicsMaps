<?php
/**
 * Permet de créer un index pour naviguer sur les différents scripts où,
 * on inclut à chaque script le menu et on renvoit un script en fonction de sa section
 */
 
include_once("Controleurs/Outils.php");
if (!isset($_GET['section']) OR $_GET['section'] == 'index') {
	include_once('Controleurs/Accueil.php');
    $nomControleur = "Accueil";
} else {
    include_once('Controleurs/' . $_GET['section'] . '.php');
    $nomControleur = $_GET['section'];
}
if (isset($_GET['action'])) {
    $methode = $_GET['action'];
} else {
    $methode = 'defaut';
}
$controleur = new $nomControleur();
$controleur->$methode();
?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|Pacifico|Roboto" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="Style/style.css">