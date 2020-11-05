<?php
class FonctionManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getList(){
		$requete = 'SELECT fon_num, fon_libelle FROM fonction';

		$result = $this->db->query($requete);

		while($fonction = $result->fetch(PDO::FETCH_OBJ)){
			$liste_fonction[] = new Fonction($fonction);
		}

		return $liste_fonction;
	}

}
?>
