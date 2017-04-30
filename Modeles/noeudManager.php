<?php

include_once("noeud.php");

class noeudManager {

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
    }

    public function getListNoeuds() {
        $liste = array();
        $query = $this->db->query('SELECT * FROM noeud');
        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = new noeud($donnees);
        }
        return $liste;
    }

    public function ajoutNoeud() {
        $query = $this->db->prepare('INSERT INTO noeud (identifiant, label, parent, estDansCarte) values (:identifiant, :label, :parent, :estDansCarte)');
        $query->bindValue(':identifiant', null, PDO::PARAM_INT);
        $query->bindValue(':label', $noeud->getLabel());
        $query->bindValue(':parent', $noeud->getParent());
        $query->bindValue(':estDansCarte', $noeud->getEstDansCartes());
        $query->execute();
        $noeud->setIdentifiant($this->db->lastInsertId());
    }

}
