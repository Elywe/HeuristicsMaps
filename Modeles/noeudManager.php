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

}
