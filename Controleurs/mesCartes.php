<?php
    include_once('Modeles/carteManager.php');
    $manager = new carteManager();
    $cartes = $manager->getList();
    include_once("Vues/vueMesCartes.php");
    include_once("Vues/vueFooter.html");
    