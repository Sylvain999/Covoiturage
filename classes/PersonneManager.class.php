<?php
class PersonneManager{

	private $db;

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


	public function getList(){
		$requete = 'SELECT per_num, per_nom, per_prenom FROM personne';

		$result = $this->db->query($requete);

		while($pers = )
	}


}
?>
