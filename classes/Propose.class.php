<?php
class Propose{
	private $par_num;
  private $per_num;
  private $pro_date;
  private $pro_time;
  private $pro_place;
  private $pro_sens;

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
				case 'per_num': $this->per_num = $valeur;
				break;
        case 'pro_date': $this->pro_date = $valeur;
				break;
        case 'pro_time': $this->pro_time = $valeur;
				break;
        case 'pro_place': $this->pro_place = $valeur;
				break;
        case 'pro_sens': $this->pro_sens = $valeur;
				break;
			}
		}
	}

  public function getParNum(){
    return $this->par_num;
  }

  public function getPerNum(){
    return $this->per_num;
  }

  public function getDate(){
    return $this->pro_date;
  }

  public function getTime(){
    return $this->pro_time;
  }

  public function getPlace(){
    return $this->pro_place;
  }

  public function getSens(){
    return $this->pro_sens;
  }


}
