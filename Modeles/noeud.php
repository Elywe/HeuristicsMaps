<?php

class noeud {

    private $identifiant;
    private $label;
    private $parent;
    private $estDansCarte;

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

    public function setIdentifiant($_identifiant) {
        $this->identifiant = $_identifiant;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($_label) {
        $this->label = $_label;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setParent($_parent) {
        $this->parent = $_parent;
    }

    public function getEstDansCarte() {
        return $this->estDansCarte;
    }

    public function setEstDansCarte($_estDansCarte) {
        $this->estDansCarte = $_estDansCarte;
    }

}
