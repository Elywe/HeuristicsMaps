<?php

class carte {

    private $identifiant;
    private $nom;
    private $racine;
    private $visibilite;

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

    public function getRacine() {
        return $this->racine;
    }

    public function setRacine($_racine) {
        $this->racine = $_racine;
    }

    public function getVisibilite() {
        return $this->visibilite;
    }

    public function setVisibilite($_visibilite) {
        $this->visibilite = $_visibilite;
    }

}
