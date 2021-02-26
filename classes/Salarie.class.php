<?php
class Salarie extends Personne{
	private $sal_telprof;
	private $fon_num;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees = array()){
		parent::affecte($donnees);
		foreach($donnees as $attribut => $valeur){
			switch ($attribut){
				case 'sal_telprof': $this->sal_telprof = $valeur;
				break;
				case 'fon_num': $this->fon_num = $valeur;
				break;
			}
		}
	}


	public function getTelprof(){
    return $this->sal_telprof;
  }

	public function getFonNum(){
    return $this->fon_num;
  }

}
