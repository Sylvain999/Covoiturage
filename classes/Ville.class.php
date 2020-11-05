<?php
class Ville{

	private $vil_num;
	private $vil_nom;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees = array()){
		foreach($donnees as $attribut => $valeur){
			switch ($attribut){
				case 'vil_num': $this->vil_num = $valeur;
				break;
				case 'vil_nom' : $this->vil_nom = $valeur;
				break;
			}
		}
	}

	public function getNom(){
		return $this->vil_nom;
	}

	public function getNum(){
		return $this->vil_num;
	}
}
