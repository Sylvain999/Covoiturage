<?php //A COMPLETER
class DepartementManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getList(){
		$requete = 'SELECT dep_num, dep_nom FROM departement';

		$result = $this->db->query($requete);

		while($parcours = $result->fetch(PDO::FETCH_OBJ)){
			$liste_departement[] = new Departement($parcours);
		}

		return $liste_departement;
	}

}
