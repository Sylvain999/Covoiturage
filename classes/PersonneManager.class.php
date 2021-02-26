<?php
class PersonneManager{

	protected $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function insert($pers){

		$requete = $this->db->prepare('INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd)
		VALUES(:per_nom, :per_prenom, :per_tel, :per_mail, :per_login, :per_pwd);');

		$requete->bindValue(':per_nom', $pers->getNom());
		$requete->bindValue(':per_prenom', $pers->getPrenom());
		$requete->bindValue(':per_tel', $pers->getTel());
		$requete->bindValue(':per_mail', $pers->getMail());
		$requete->bindValue(':per_login', $pers->getLogin());
		$requete->bindValue(':per_pwd', $pers->getPwd());

		$result = $requete->execute();

		return $result;

	}


	public function update($pers){

		$requete = $this->db->prepare('UPDATE personne SET per_nom=:per_nom, per_prenom=:per_prenom, per_tel=:per_tel,
		per_mail=:per_mail WHERE per_num=:per_num');

		$requete->bindValue(':per_nom', $pers->getNom());
		$requete->bindValue(':per_prenom', $pers->getPrenom());
		$requete->bindValue(':per_tel', $pers->getTel());
		$requete->bindValue(':per_mail', $pers->getMail());
		$requete->bindValue(':per_num', $pers->getNum());

		$result = $requete->execute();

		return $result;

	}

	public function getList(){
		$requete = 'SELECT per_num, per_nom, per_prenom FROM personne';

		$result = $this->db->query($requete);

		$listePersonnes = array();

		while($pers = $result->fetch(PDO::FETCH_OBJ)){
			$listePersonnes[] = new Personne($pers);
		}

		return $listePersonnes;
	}

	public function contains($num){
		$requete = 'SELECT per_num FROM personne WHERE per_num='.$num;

		$result = $this->db->query($requete);

		while($pers = $result->fetch(PDO::FETCH_OBJ)){
			$listePersonnes[] = new Personne($pers);
		}

		if (empty($listePersonnes)){
			return false;
		}else{
			return true;
		}
	}

	public function delete($num){
		$requete = 'DELETE FROM propose WHERE per_num='.$num;
		if (!$this->db->query($requete)){
			return false;
		}

		$requete = 'DELETE FROM avis WHERE per_num='.$num.' OR per_per_num='.$num;
		if (!$this->db->query($requete)){
			return false;
		}

		$requete = 'DELETE FROM personne WHERE per_num='.$num;
		return $this->db->query($requete);
	}



	public function getNbPersonnes(){
		$requete = 'SELECT count(*) AS nbPersonnes FROM personne';

		$result = $this->db->query($requete);

		return $result->fetch(PDO::FETCH_OBJ)->nbPersonnes;
	}

	public function getPers($num){
		$requete = "SELECT per_prenom, per_mail, per_tel FROM personne WHERE per_num =$num";

		$result = $this->db->query($requete);

		return new Personne($result->fetch(PDO::FETCH_OBJ));
	}

	public function getCategorie($num){
		$requete = "SELECT 'etudiant' as categorie FROM etudiant WHERE per_num=$num
								UNION SELECT 'salarie' FROM salarie WHERE per_num=$num";

		$result = $this->db->query($requete);

		$tab = $result->fetch(PDO::FETCH_OBJ);

		return $tab->categorie;
	}

	public function getPersonneByLoginAndPwd($login, $pwd){
		$requete = "SELECT per_num, per_login 
					FROM personne 
					WHERE per_login='$login' AND per_pwd='$pwd'";

		$result = $this->db->query($requete)->fetch(PDO::FETCH_ASSOC);

		if(empty($result)){
			return null;
		}else{
			return new Personne($result);
		}
	}
}
?>
