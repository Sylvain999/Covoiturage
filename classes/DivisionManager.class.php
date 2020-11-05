<?php
class DivisionManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getList(){
		$requete = 'SELECT div_num, div_nom FROM division';

		$result = $this->db->query($requete);

		while($division = $result->fetch(PDO::FETCH_OBJ)){
			$liste_division[] = new Division($division);
		}

		return $liste_division;
	}
}
?>
