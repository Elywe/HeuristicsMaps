<?php

include_once("carte.php");
include_once("noeud.php");

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

    public function ajouterCarte($carte) {
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

    public function renommerCarte($idCarte, $nouveauNom) {
        $query = $this->db->prepare('UPDATE carte
			SET nom=:nom
			WHERE identifiant=:id');
        $query->bindValue(':id', $idCarte, PDO::PARAM_INT);
        $query->bindValue(':nom', $nouveauNom);
        $query->execute();
    }

    public function supprimerCarte($idCarte) {
        $query = $this->db->prepare('DELETE FROM carte WHERE identifiant=:id');
        $query->bindValue(':id', $idCarte, PDO::PARAM_INT);
        $query->execute();
    }

    public function getNoeud($idNoeud) {
        $query = $this->db->prepare('SELECT * FROM noeud where identifiant = :id');
        $query->bindValue(':id', $idNoeud, PDO::PARAM_INT);
        $query->execute();
        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        $noeud = new noeud($donnees);
        return $noeud;
    }

    public function getCarte($idCarte) {
        $query = $this->db->prepare('SELECT * FROM carte where identifiant = :id');
        $query->bindValue(':id', $idCarte, PDO::PARAM_INT);
        $query->execute();
        $donnees = $query->fetch(PDO::FETCH_ASSOC);
        $carte = new carte($donnees);
        return $carte;
    }

    public function getListNoeuds() {
        $liste = array();
        $query = $this->db->query('SELECT * FROM noeud');
        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = new noeud($donnees);
        }
        return $liste;
    }

    public function ajoutNoeud($label, $parent, $carte) {
        $query = $this->db->prepare('INSERT INTO noeud (identifiant, label, parent, estDansCarte) values (:identifiant, :label, :parent, :estDansCarte)');
        $query->bindValue(':identifiant', null, PDO::PARAM_INT);
        $query->bindValue(':label', $label);
        $query->bindValue(':parent', $parent);
        $query->bindValue(':estDansCarte', $carte);
        $query->execute();
    }

    public function supprimerNoeud($idNoeud) {
        $query = $this->db->prepare('DELETE FROM noeud WHERE identifiant=:id');
        $query->bindValue(':id', $idNoeud, PDO::PARAM_INT);
        $query->execute();
    }

    public function getListPourUneCarte($idCarte) {
        $liste = array();
        $query = $this->db->prepare('SELECT * FROM noeud where noeud.estDansCarte = :identifiant');
        $query->bindValue(':identifiant', $idCarte, PDO::PARAM_INT);
        $query->execute();
        while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = new noeud($donnees);
        }
        foreach ($liste as $noeud) {
            if ($noeud->getParent() != NULL) {
                foreach ($liste as $parentP) {
                    if ($noeud->getParent() == $parentP->getIdentifiant()) {
                        $parentP->ajouterEnfant($noeud);
                        break;
                    }
                }
            }
        }
        return $liste;
    }

}
