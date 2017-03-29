<?php
/**
 * Permet de créer un index pour naviguer sur les différents scripts où,
 * on inclut à chaque script le menu et on renvoit un script en fonction de sa section
 */
include_once('Vues/vueMenu.html');
if (!isset($_GET['section']) OR $_GET['section'] == 'index') {
    include_once('Controleurs/Menu.php');
    $nomControleur = "Menu";
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
<link rel="stylesheet" type="text/css" href="Style/style.css">