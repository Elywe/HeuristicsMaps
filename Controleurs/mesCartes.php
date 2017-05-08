<?php

class mesCartes {

    public function defaut() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $managerCarte = new carteManager();
        $donnees["cartes"] = $managerCarte->getListCartes();
        if (isset($_POST["carte"])) {
			include_once('Modeles/utilisateurManager.php');
			if(isset($_SESSION['pseudo'])){
				$utilMana = new utilisateurManager();
				$_SESSION["droit"]=$utilMana->droit($_POST["carte"]);
            }
            $donnees["noeuds"] = $managerCarte->getListPourUneCarte($_POST["carte"]);
        }
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

    public function voirCarte() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $managerCarte = new carteManager();
		$donnees["cartes"] = $managerCarte->getListCartes();
        if (isset($_GET["carte"])) {
			$donnees["noeuds"] = $managerCarte->getListPourUneCarte($_GET["carte"]);
            $donnees['idCarte'] = $_GET['carte'];
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
        $manager->ajoutNoeud("root", null, $carte->getIdentifiant());
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
        if (isset($_SESSION['pseudo'])) {
			include_once('Modeles/utilisateurManager.php');
			$uManager = new utilisateurManager();
            $donnees["utilisateurs"] = $uManager->getList();
            $donnees["utilCarte"] = $uManager->getListCarte($_GET['idCarte']);
            $donnees["droit"] = $uManager->droit($_GET['idCarte']);
		}
            $donnees["carte"] = $carte;
        $donnees["cartes"] = $manager->getListCartes();
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }
	
	public function changeDroit(){
		$donnees["titre"] = "Mes cartes";
		include_once('Modeles/utilisateurManager.php');
		$uManager = new utilisateurManager();
		$uManager->modifDroit($_POST['idCarte'],$_POST['utilisateur'],$_POST['role']);
		Header('Location: index.php?section=mesCartes&action=partageCarte&idCarte='.$_POST['idCarte']);
	}

    public function ajoutNoeud() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        $idCarte = htmlspecialchars($_GET['idCarte']);
        $idNoeud = htmlspecialchars($_GET['idNoeud']);
        $label = htmlspecialchars($_GET['label']);
        $manager->ajoutNoeud($label, $idNoeud, $idCarte);
        $donnees["idCarte"] = $idCarte;
        $donnees["cartes"] = $manager->getListCartes();
        $donnees["noeuds"] = $manager->getListPourUneCarte($idCarte);
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

    public function supprimerNoeud() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        $idCarte = htmlspecialchars($_GET['idCarte']);
        $idNoeud = htmlspecialchars($_GET['idNoeud']);
        if ($manager->getNoeud($idNoeud)->getParent() == NULL) {
            $donnees['erreur'] = "Impossible de supprimer le noeud root.";
        } else {
            $manager->supprimerNoeud($idNoeud);
        }
        $donnees["idCarte"] = $idCarte;
        $donnees["cartes"] = $manager->getListCartes();
        $donnees["noeuds"] = $manager->getListPourUneCarte($idCarte);
        afficherVues("Vues/vueMesCartes.php", $donnees);
    }

    public function renommerNoeud() {
        $donnees["titre"] = "Mes cartes";
        include_once('Modeles/carteManager.php');
        $manager = new carteManager();
        $idNoeudARenommer = htmlspecialchars($_GET['idNoeud']);
        $nouveauNom = htmlspecialchars($_GET['label']);
        $manager->renommerNoeud($idNoeudARenommer, $nouveauNom);
        $this->voirCarte();
    }

}
