<?php

class connexion {

    public function defaut() {
        $donnees["titre"] = "Connexion";
        include_once('Modeles/carteManager.php');
        afficherVues("Vues/vueConnexion.php", $donnees);
    }

    public function ajoutUtilisateur() {
        
    }

}
