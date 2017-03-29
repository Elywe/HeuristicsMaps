<?php

class mesCartes {

    public function defaut() {

        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        $methode = "getList";
        $cartes = $manager->$methode();
        include_once("Vues/vueMesCartes.php");
        include_once("Vues/vueFooter.html");
    }

    public function ajouter() {
        include_once('Modeles/carteManager.php');
        echo "<h1>Ajouter</h1>";
        include_once("Vues/vueFooter.html");
    }

}
