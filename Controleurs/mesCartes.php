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

    public function ajoutCarte() {
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        if (isset($_POST['Valider'])) {
            unset($_POST['Valider']);
            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars($value);
            }
            $carte = new carte($_POST);
            $manager->ajouter($carte);
        }
        $cartes = $manager->getList();
        include_once("Vues/vueMesCartes.php");
        include_once("Vues/vueFooter.html");
    }

    public function supprimerCarte() {
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        if (isset($_POST['Supprimer'])) {
            $carteASupprimer = htmlspecialchars($_POST['carte']);
            $manager->supprimer($carteASupprimer);
            $cartes = $manager->getList();
            require_once("Vues/vueMenu.html");
            include_once("Vues/vueMesCartes.php");
            include_once("Vues/vueFooter.html");
        }
    }

}
