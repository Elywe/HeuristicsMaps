<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cartes
 *
 * @author Mélina
 */
class carte {

    private $identifiant;
    private $nom;

    function __construct($argument) {
        foreach ($argument as $k => $v) {
            $this->$k = $v;
        }
    }

    public function hydrate($argument) {
        foreach ($argument as $k => $v) {
            $this->$k = $v;
        }
    }

    public function getIdentifiant() {
        return $this->identifiant;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setIdentifiant($_id) {
        $this->identifiant = $_id;
    }

    public function setNom($_nom) {
        $this->nom = $_nom;
    }

}
