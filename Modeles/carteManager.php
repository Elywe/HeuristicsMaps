<?php

include_once("carte.php");

class carteManager {

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
    }

    public function getListCartes() {
        $liste = array();
        if (isset($_SESSION['identifiant'])) {
            $query = $this->db->query("SELECT distinct identifiant,nom,racine,visibilite FROM carte,utilise  where visibilite='public' or identifiant=idCarte and idUtilisateur=" . $_SESSION['identifiant']);
        } else {
            $query = $this->db->query("SELECT identifiant,nom,racine,visibilite FROM carte  where visibilite='public'");
        }
        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = new carte($donnees);
        }
        return $liste;
    }

    public function ajouter($carte) {
        $query = $this->db->prepare('INSERT INTO carte (identifiant, nom, racine,visibilite) values (:identifiant, :nom, :racine, :visibilite)');
        $query->bindValue(':identifiant', null, PDO::PARAM_INT);
        $query->bindValue(':nom', $carte->getNom());
        $query->bindValue(':visibilite', $carte->getVisibilite());
        $query->bindValue(':racine', null, PDO::PARAM_INT);
        $query->execute();
        $carte->setIdentifiant($this->db->lastInsertId());

        $query = $this->db->prepare("INSERT INTO utilise values (:idCarte, :idUtilisateur, 'createur')");
        $query->bindValue(':idCarte', $carte->getIdentifiant());
        $query->bindValue(':idUtilisateur', $_SESSION['identifiant']);
        $query->execute();
    }

    public function update($carte) {
        $query = $this->db->prepare('UPDATE carte
			SET identifiant=:identifiant, nom=:nom, racine=:racine
			WHERE identifiant=:id');
        $query->bindValue(':id', $carte->getIdentifiant(), PDO::PARAM_INT);
        $query->bindValue(':nom', $carte->getNom());
        $query->bindValue(':racine', $carte->getRacine(), PDO::PARAM_INT);
        $query->execute();
    }

    public function supprimer($idCarte) {
        $query = $this->db->prepare('DELETE FROM carte WHERE identifiant=:id');
        $query->bindValue(':id', $idCarte, PDO::PARAM_INT);
        $query->execute();
    }

}
