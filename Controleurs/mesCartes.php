<?php

class mesCartes {

    public function defaut() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $managerCarte = new carteManager();
        $donnees["cartes"] = $managerCarte->getListCartes();
        if (isset($_POST["carte"])) {
            $donnees["noeuds"] = $managerCarte->getListPourUneCarte($_POST["carte"]);
        }
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
            $manager->ajouterCarte($carte);
        }
        $donnees["cartes"] = $manager->getListCartes();
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

    public function supprimerCarte() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        $carteASupprimer = htmlspecialchars($_GET['idCarte']);
        $manager->supprimerCarte($carteASupprimer);
        $donnees["cartes"] = $manager->getListCartes();
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

    public function renommerCarte() {
        $donnees["titre"] = "Renommer une carte";
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        $carteARenommer = htmlspecialchars($_POST['idCarte']);
        $nouveauNom = htmlspecialchars($_POST['nom']);
        $manager->renommerCarte($carteARenommer, $nouveauNom);
        $this->defaut();
    }

    public function renommerCarteFormulaire() {
        $donnees["titre"] = "Renommer une carte";
        $donnees["idCarte"] = htmlspecialchars($_GET['idCarte']);
        $donnees["nomCarte"] = htmlspecialchars($_GET['nomCarte']);
        afficherVues("Vues/vueRenommerCarte.php", $donnees);
    }

    public function partageCarte() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        $idCarteAPartager = htmlspecialchars($_GET['idCarte']);
        $carte = $manager->getCarte($idCarteAPartager);
        if ($carte->getVisibilite() == "public") {
            $donnees["carte"] = $carte;
        } else {
            $donnees['erreur'] = "On ne peut pas partager une carte privée.";
        }
        $donnees["cartes"] = $manager->getListCartes();
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

}
