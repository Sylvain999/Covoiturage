<?php
class Etudiant{
	private $per_num;
	private $dep_num;
	private $div_num;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees = array()){
		foreach($donnees as $attribut => $valeur){
			switch ($attribut){
				case 'per_num': $this->per_num = $valeur;
				break;
				case 'dep_num': $this->dep_num = $valeur;
				break;
				case 'div_num': $this->div_num = $valeur;
				break;
			}
		}
	}

	public function getPerNum(){
		return $this->per_num;
	}

	public function getDepNum(){
		return $this->dep_num;
	}

	public function getDivNum(){
		return $this->div_num;
	}

	public function setPerNum($per){
		$this->per_num = $per;
	}

}
?>
