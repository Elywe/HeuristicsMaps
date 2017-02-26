<?php

include_once("carte.php");

class carteManager {

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
    }

    public function getList() {
        $liste = array();
        $query = $this->db->query('SELECT * FROM carte');
        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = new carte($donnees);
        }
        return $liste;
    }

}
