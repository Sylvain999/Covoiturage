<?php
class Parcours{

	private $par_num;
	private $par_km;
	private $vil_num1;
	private $vil_num2;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}


	public function affecte($donnees = array()){
		foreach($donnees as $attribut => $valeur){
			switch ($attribut){
				case 'par_num': $this->par_num = $valeur;
				break;
				case 'par_km' : $this->par_km = $valeur;
				break;
				case 'vil_num1' : $this->vil_num1 = $valeur;
				break;
				case 'vil_num2' : $this->vil_num2 = $valeur;
				break;
			}
		}
	}


	public function getParNum(){
		return $this->par_num;
	}

	public function getVille1(){
		return $this->vil_num1;
	}

	public function getVille2(){
		return $this->vil_num2;
	}

	public function getParKm(){
		return $this->par_km;
	}

}
