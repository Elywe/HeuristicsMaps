<?php

class partage {


    public function defaut() {
        include_once('Modeles/carteManager.php'); 
        $managerCarte = new carteManager();
        $donnees["carte"] = $managerCarte->getCarte($_GET['numCarte']);    
        $donnees["titre"] = "Carte ". $donnees["carte"]->getNom();       
        $donnees["noeuds"] = $managerCarte->getListPourUneCarte($_GET['numCarte']);
        afficherVues("Vues/vuePartageCarte.php", $donnees);
    }

    public function edition(){

        /* ------- Edition --------- */
    }
}
