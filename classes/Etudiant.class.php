<?php
class Etudiant extends Personne{
	private $dep_num;
	private $div_num;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees = array()){
		parent::affecte($donnees);
		foreach($donnees as $attribut => $valeur){
			switch ($attribut){
				case 'dep_num': $this->dep_num = $valeur;
				break;
				case 'div_num': $this->div_num = $valeur;
				break;
			}
		}
	}

	public function getDepNum(){
		return $this->dep_num;
	}

	public function getDivNum(){
		return $this->div_num;
	}

}
?>
