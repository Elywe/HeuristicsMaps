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
    
	public function getListCarte($idCarte) {
		$liste = array();
        $query = $this->db->query('SELECT utilisateur.pseudo, utilise.role FROM utilisateur,utilise where utilisateur.identifiant=utilise.idUtilisateur and utilise.idCarte='.$idCarte);
         while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = $donnees;
        }
		return $liste;
    }	

    public function ajouter($utilisateur) {
        $query = $this->db->prepare('INSERT INTO utilisateur (identifiant, pseudo, mdp) values (:identifiant, :pseudo, :mdp)');
        $query->bindValue(':identifiant', null, PDO::PARAM_INT);
        $query->bindValue(':pseudo', $utilisateur->getPseudo());
        $query->bindValue(':mdp', $utilisateur->getMdp());
        $query->execute();
        $utilisateur->setIdentifiant($this->db->lastInsertId());
    }

    public function getlogin($pseudo, $mdp) {
        
		$sql = $this->db->query("SELECT identifiant,pseudo,mdp FROM utilisateur where pseudo='" . $pseudo . "'");
        $donnees = $sql->fetch(PDO::FETCH_ASSOC);
		if (password_verify($mdp, $donnees['mdp'])) {
            $_SESSION['identifiant'] = $donnees['identifiant'];
            $_SESSION['pseudo'] = $donnees['pseudo'];  //ouverture de la session de l'utilisateur à la connexion
            $_SESSION['mdp'] = $donnees['mdp'];
            return 'Connecte';
        } else {
            return 'Login ou mot de passe erroné.';
        }
		/*$sql = $this->db->query("SELECT identifiant,pseudo,mdp FROM utilisateur where pseudo='" . $pseudo . "' and mdp='" . $mdp . "'");
        if ($donnees = $sql->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['identifiant'] = $donnees['identifiant'];
            $_SESSION['pseudo'] = $donnees['pseudo'];  //ouverture de la session de l'utilisateur à la connexion
            $_SESSION['mdp'] = $mdp;
            return 'Connecte';
        } else {
            return 'Utilisateur non reconnu';
        }*/
    }

    public function update($utilisateur) {
        $query = $this->db->query("UPDATE utilisateur SET mdp='" . $utilisateur->getMdp() . "' WHERE identifiant=" . $utilisateur->getIdentifiant());
        $_SESSION['identifiant'] = $utilisateur->getIdentifiant();
        $_SESSION['pseudo'] = $utilisateur->getPseudo();  //ouverture de la session de l'utilisateur à la connexion
        $_SESSION['mdp'] = $utilisateur->getMdp();
    }

    public function supprimer($idUtilisateur) {
        $query = $this->db->prepare('DELETE FROM utilisateur WHERE identifiant=:id');
        $query->bindValue(':id', $idUtilisateur, PDO::PARAM_INT);
        $query->execute();
    }
	
	public function droit($idCarte){
		$sql = $this->db->query("SELECT role FROM utilise where idUtilisateur='" . $_SESSION['identifiant'] . "' and idCarte ='".$idCarte."'");
		$donnees = $sql->fetch(PDO::FETCH_ASSOC);
		return $donnees['role'];
	}
	
	public function modifDroit($idCarte,$idUtilisateur,$role){
		$verif = $this->db->query("select role from utilise where idCarte=".$idCarte." and idUtilisateur=".$idUtilisateur);
		if($verif->fetch(PDO::FETCH_ASSOC)){
			$sql = $this->db->query("update utilise set role='".$role."' where idCarte=".$idCarte." and idUtilisateur=".$idUtilisateur);
		}else{
			$sql = $this->db->query("insert into utilise values(".$idCarte.", ".$idUtilisateur.", '".$role."')");		
		}
	}

}
