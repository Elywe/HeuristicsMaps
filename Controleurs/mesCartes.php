<?php

class mesCartes {

    public function defaut() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        include_once('Modeles/noeudManager.php');
        $managerCarte = new carteManager();
        $managerNoeud = new noeudManager();
        $donnees["cartes"] = $managerCarte->getListCartes();
        $donnees["noeuds"] = $managerNoeud->getListNoeuds();
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

    public function ajoutCarte() {
        $donnees["titre"] = "Mes cartes";
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
        $donnees["cartes"] = $manager->getListCartes();
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

    public function supprimerCarte() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        if (isset($_POST['Supprimer']) && isset($_POST['carte'])) {
            $carteASupprimer = htmlspecialchars($_POST['carte']);
            $manager->supprimer($carteASupprimer);
        } else {
            $donnees['erreur'] = "Pas de carte sélectionnée.";
        }
        $donnees["cartes"] = $manager->getListCartes();
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

}
