<?php
class Fonction{
	private $fon_num;
	private $fon_libelle;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees = array()){
		foreach($donnees as $attribut => $valeur){
			switch ($attribut){
				case 'fon_num': $this->fon_num = $valeur;
				break;
				case 'fon_libelle': $this->fon_libelle = $valeur;
				break;
			}
		}
	}

	public function getNum(){
		return $this->fon_num;
	}

	public function getLibelle(){
		return $this->fon_libelle;
	}

}
