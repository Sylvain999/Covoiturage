<?php
class VilleManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function insert($ville){
		$requete = $this->db->prepare('INSERT INTO ville (vil_nom) VALUES(:vil_nom);');

		$requete->bindValue(':vil_nom', $ville->getNom());

		$result = $requete->execute();

		return $result;
	}


	public function nbVilles(){
		$requete = 'SELECT count(*) AS nbVilles FROM ville';

		$result = $this->db->query($requete);

		return $result->fetch(PDO::FETCH_OBJ)->nbVilles;
	}

	public function getList(){
		$requete = 'SELECT vil_num, vil_nom FROM ville ORDER BY vil_nom';

		$result = $this->db->query($requete);

		while($client = $result->fetch(PDO::FETCH_OBJ)){
			$liste_villes[] = new Ville($client);
		}

		return $liste_villes;
	}


	public function getVilleById($num){
		$requete = "SELECT vil_num, vil_nom FROM ville WHERE vil_num = $num";

		$result = $this->db->query($requete);

		return new Ville($result->fetch(PDO::FETCH_OBJ));
	}

}
?>
