<?php
class Salarie{
	private $per_num;
	private $sal_telprof;
	private $fon_num;

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
        case 'sal_telprof': $this->sal_telprof = $valeur;
				break;
        case 'fon_num': $this->fon_num = $valeur;
				break;
			}
		}
	}


	public function getPerNum(){
    return $this->per_num;
  }

	public function getTelprof(){
    return $this->sal_telprof;
  }

	public function getFonNum(){
    return $this->fon_num;
  }

	public function setPerNum($per){
		$this->per_num=$per;
	}

}
