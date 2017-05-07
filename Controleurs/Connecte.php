<?php

class connecte {

    public function defaut() {
        if (isset($_SESSION['pseudo'])) {
            $donnees["titre"] = "Votre profil";
            include_once('Modeles/utilisateur.php');
            afficherVues("Vues/vueConnecte.html", $donnees);
        } else {
            $donnees["titre"] = "Connexion";
            afficherVues("Vues/vueConnexion.php", $donnees);
        }
    }

    public function modMdp() {
        include_once('Modeles/utilisateur.php');
        include_once('Modeles/utilisateurManager.php');
        $util = new utilisateur($_SESSION);
        $mdp = htmlspecialchars($_POST['passChange']);
        //$util->setMdp($mdp);
        $util->setMdp(password_hash($mdp, PASSWORD_DEFAULT));
        $mana = new utilisateurManager();
        $mana->update($util);
        $donnees["titre"] = "Votre profil";
        $donnees['erreur'] = "Mot de passe changé avec succès";
        afficherVues("Vues/vueConnecte.html", $donnees);
    }

}

?>