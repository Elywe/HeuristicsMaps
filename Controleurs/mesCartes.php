<?php

class mesCartes {

    public function defaut() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        $methode = "getList";
        $donnees["cartes"] = $manager->$methode();
        afficherVues("Vues/vueMesCartes.php", $donnees);
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
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

    public function supprimerCarte() {
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        if (isset($_POST['Supprimer'])) {
            $carteASupprimer = htmlspecialchars($_POST['carte']);
            $manager->supprimer($carteASupprimer);
            $cartes = $manager->getList();
            afficherVues("Vues/vueMesCartes.php", $donnees);
        }
    }

}
