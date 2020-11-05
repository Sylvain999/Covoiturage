<?php
class EtudiantManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function insert($etudiant){

		$requete = $this->db->prepare('INSERT INTO etudiant (per_num, dep_num, div_num)
		VALUES(:per_num, :dep_num, :div_num);');

		$requete->bindValue(':per_num', $etudiant->getPerNum());
		$requete->bindValue(':dep_num', $etudiant->getDepNum());
		$requete->bindValue(':div_num', $etudiant->getDivNum());

		$result = $requete->execute();

		return $result;

	}

}
