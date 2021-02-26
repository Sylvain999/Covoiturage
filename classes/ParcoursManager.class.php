<?php
class ParcoursManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function insert($parcours){
		$requete = $this->db->prepare('INSERT INTO parcours (par_km, vil_num1, vil_num2) 
									VALUES(:par_km, :vil_num1, :vil_num2);');

		$requete->bindValue(':par_km', $parcours->getParKm());
		$requete->bindValue(':vil_num1', $parcours->getVille1());
		$requete->bindValue(':vil_num2', $parcours->getVille2());

		$result = $requete->execute();

		return $result;
	}


	public function canInsertParcours($parcours){
		if($parcours->getVille1() == $parcours->getVille2()){
			return false;
		}else{
			$requete = ('SELECT par_num 
						FROM parcours
						WHERE (vil_num1 ='.$parcours->getVille1().' AND vil_num2 ='.$parcours->getVille2()
						.') OR (vil_num1 ='.$parcours->getVille2().' AND vil_num2 ='.$parcours->getVille1()).')';

			$result = $this->db->query($requete)->fetch(PDO::FETCH_ASSOC);

			return empty($result);
		}
		
	}


	public function nbParcours(){
		$requete = 'SELECT count(*) AS nbParcours FROM parcours';

		$result = $this->db->query($requete);

		return $result->fetch(PDO::FETCH_OBJ)->nbParcours;
	}

	public function getList(){
		$requete = 'SELECT par_num, par_km, vil_num1, vil_num2 FROM parcours';

		$result = $this->db->query($requete);

		while($parcours = $result->fetch(PDO::FETCH_OBJ)){
			$liste_parcours[] = new Parcours($parcours);
		}

		return $liste_parcours;
	}


	public function getListVille(){
		$requete = 'SELECT vil_num, vil_nom FROM ville
					WHERE vil_num IN 
						(SELECT vil_num1 FROM parcours
						UNION
						SELECT vil_num2 FROM parcours)';

		$result = $this->db->query($requete);

		while($ville = $result->fetch(PDO::FETCH_OBJ)){
			$liste_ville[] = new Ville($ville);
		}

		return $liste_ville;
	}


	public function getListVilleParcoursWith($num){
		$requete = "SELECT par_num, vil_num, vil_nom 
					FROM parcours p INNER JOIN ville v ON p.vil_num1 = v.vil_num
					WHERE p.vil_num2 = $num
					UNION
					SELECT par_num, vil_num, vil_nom 
					FROM parcours p INNER JOIN ville v ON p.vil_num2 = v.vil_num
					WHERE p.vil_num1 = $num";

		$result = $this->db->query($requete);

		while($ville = $result->fetch(PDO::FETCH_OBJ)){
			$liste_ville[$ville->par_num] = new Ville($ville);
		}

		return $liste_ville;
	}

	public function getSensVilleByNum($par_num, $vilnum){
		$requete = "SELECT CASE
					WHEN vil_num1 = $vilnum THEN 0
					WHEN vil_num2 = $vilnum THEN 1
					ELSE -1
					END AS pro_sens
					FROM parcours
					WHERE par_num = $par_num";
		
		$result = $this->db->query($requete);

		return $result->fetch(PDO::FETCH_ASSOC)["pro_sens"];
	}


	public function getListVilleDepart(){
		$requete = 'SELECT vil_num, vil_nom FROM ville
					WHERE vil_num IN 
						(SELECT CASE pro_sens
							WHEN 0 THEN vil_num1
							ELSE vil_num2
							END AS vil_num
							FROM parcours pa INNER JOIN propose pr ON pa.par_num = pr.par_num)';

		$result = $this->db->query($requete);

		while($ville = $result->fetch(PDO::FETCH_OBJ)){
			$liste_ville[] = new Ville($ville);
		}

		return $liste_ville;
	}


	public function getNomVille1($parcours){
		$requete = "SELECT vil_nom 
					FROM ville
					WHERE vil_num =".$parcours->getVille1();

		$result = $this->db->query($requete);

		return $result->fetch(PDO::FETCH_OBJ)->vil_nom;
	}

	public function getNomVille2($parcours){
		$requete = "SELECT vil_nom 
					FROM ville
					WHERE vil_num =".$parcours->getVille2();

		$result = $this->db->query($requete);

		return $result->fetch(PDO::FETCH_OBJ)->vil_nom;
	}

	

}

?>
