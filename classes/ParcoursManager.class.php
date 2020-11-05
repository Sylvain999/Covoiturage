<?php
class ParcoursManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function inserer($parcours){
		$requete = $this->db->prepare('INSERT INTO parcours (par_km, vil_num1, vil_num2) VALUES(:par_km, :vil_num1, :vil_num2);');

		$requete->bindValue(':par_km', $parcours->getParKm());
		$requete->bindValue(':vil_num1', $parcours->getVille1());
		$requete->bindValue(':vil_num2', $parcours->getVille2());

		$result = $requete->execute();

		return $result;
	}


	public function nbParcours(){
		$requete = 'SELECT count(*) AS nbParcours FROM parcours';

		$result = $this->db->query($requete);

		$nb = $result->fetch(PDO::FETCH_OBJ);

		return $nb;
	}

	public function getList(){
		$requete = 'SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours';

		$result = $this->db->query($requete);

		while($parcours = $result->fetch(PDO::FETCH_OBJ)){
			$liste_parcours[] = new Parcours($parcours);
		}

		return $liste_parcours;
	}

}

?>
