<?php
class Division{
	private $div_num;
	private $div_nom;

	public function __construct($valeurs = array()){
		if (!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees = array()){
		foreach($donnees as $attribut => $valeur){
			switch ($attribut){
				case 'div_num': $this->div_num = $valeur;
				break;
				case 'div_nom': $this->div_nom = $valeur;
				break;
			}
		}
	}

	public function getNum(){
		return $this->div_num;
	}

	public function getNom(){
		return $this->div_nom;
	}

}

?>
