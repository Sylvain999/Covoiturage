<?php
class Personne{

	private $per_num;
	private $per_nom;
	private $per_prenom;
	private $per_tel;
	private $per_mail;
	private $per_login;
	private $per_pwd;

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
				case 'per_nom': $this->per_nom = $valeur;
				break;
				case 'per_prenom': $this->per_prenom = $valeur;
				break;
				case 'per_tel': $this->per_tel = $valeur;
				break;
				case 'per_mail': $this->per_mail = $valeur;
				break;
				case 'per_login': $this->per_login = $valeur;
				break;
				case 'per_pwd': $this->per_pwd = sha1($valeur);
				break;
			}
		}
	}

	public function getNum(){
		return $this->per_num;
	}

	public function getNom(){
		return $this->per_nom;
	}

	public function getPrenom(){
		return $this->per_prenom;
	}

	public function getTel(){
		return $this->per_tel;
	}

	public function getMail(){
		return $this->per_mail;
	}

	public function getLogin(){
		return $this->per_login;
	}

	public function getPwd(){
		return $this->per_pwd;
	}


	public function setNum($num){
		$this->per_num = $num;
	}

}
