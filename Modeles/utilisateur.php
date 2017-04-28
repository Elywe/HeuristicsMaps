<?php

class utilisateur {

    private $identifiant;
    private $pseudo;
    private $mdp;

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

    public function setIdentifiant($_id) {
        $this->identifiant = $_id;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo($_pseudo) {
        $this->pseudo = $_pseudo;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function setMdp($_mdp) {
        $this->mdp = $_mdp;
    }

}
