<?php
class VilleManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function inserer($ville){
		$requete = $this->db->prepare('INSERT INTO ville (vil_nom) VALUES(:vil_nom);');

		$requete->bindValue(':vil_nom', $ville->getNom());

		$result = $requete->execute();

		return $result;
	}


	public function nbVilles(){
		$requete = 'SELECT count(*) AS nbVilles FROM ville';

		$result = $this->db->query($requete);

		$nb = $result->fetch(PDO::FETCH_OBJ);

		return $nb;
	}

	public function getList(){
		$requete = 'SELECT vil_num, vil_nom FROM ville';

		$result = $this->db->query($requete);

		while($client = $result->fetch(PDO::FETCH_OBJ)){
			$liste_villes[] = new Ville($client);
		}

		return $liste_villes;
	}

}
?>
