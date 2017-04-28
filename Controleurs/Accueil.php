<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accueil
 *
 * @author Mélina
 */
class Accueil {

    public function defaut() {
        $donnees["titre"] = "Accueil";
        include_once('Modeles/carteManager.php');
        afficherVues("Vues/vueAccueil.php", $donnees);
    }

}
