<?php

include_once("utilisateur.php");

class utilisateurManager {

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
    }

    public function getList() {
        $liste = array();
        $query = $this->db->query('SELECT * FROM utilisateur');
        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = new utilisateur($donnees);
        }
        return $liste;
    }

    public function ajouter($utilisateur) {
        $query = $this->db->prepare('INSERT INTO utilisateur (identifiant, pseudo, mdp) values (:identifiant, :pseudo, :mdp)');
        $query->bindValue(':identifiant', null, PDO::PARAM_INT);
        $query->bindValue(':pseudo', $utilisateur->getNom());
        $query->bindValue(':mdp', $utilisateur->getMdp());
        $query->execute();
        $utilisateur->setIdentifiant($this->db->lastInsertId());
    }

    public function update($utilisateur) {
        $query = $this->db->prepare('UPDATE utilisateur
			SET identifiant=:identifiant, pseudo=:pseudo, mdp=:mdp
			WHERE identifiant=:id');
        $query->bindValue(':id', $utilisateur->getIdentifiant(), PDO::PARAM_INT);
        $query->bindValue(':pseudo', $utilisateur->getPseudo());
        $query->bindValue(':mdp', $utilisateur->getMdp());
        $query->execute();
    }

    public function supprimer($idUtilisateur) {
        $query = $this->db->prepare('DELETE FROM utilisateur WHERE identifiant=:id');
        $query->bindValue(':id', $idUtilisateur, PDO::PARAM_INT);
        $query->execute();
    }

}
