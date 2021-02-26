<?php
class ProposeManager{

	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	
	public function inserer($propose){
		$requete = $this->db->prepare('INSERT INTO propose (par_num, per_num, pro_date, pro_time, pro_place, pro_sens) 
										VALUES(:par_num, :per_num, :pro_date, :pro_time, :pro_place, :pro_sens);');

		$requete->bindValue(':par_num', $propose->getParNum());
		$requete->bindValue(':per_num', $propose->getPerNum());
		$requete->bindValue(':pro_date', $propose->getDate());
		$requete->bindValue(':pro_time', $propose->getTime());
		$requete->bindValue(':pro_place', $propose->getPlace());
		$requete->bindValue(':pro_sens', $propose->getSens());

		$result = $requete->execute();

		return $result;
	}


	public function getListProposeWithParcours($infos){
		$requete = 'SELECT DISTINCT pr.par_num, per_num, pro_date, pro_time, pro_place, pro_sens
					FROM propose pr INNER JOIN parcours pa ON pr.par_num = pa.par_num
					WHERE pr.par_num = '.$infos["par_num"]
						.' AND pro_date BETWEEN \''.date('Y-m-d', strtotime('-'.$infos["precision"].' day',strtotime($infos["pro_date"]))).'\''
							.'AND \''.date('Y-m-d', strtotime('+'.$infos["precision"].' day',strtotime($infos["pro_date"]))).'\''
						.' AND pro_time >= \''.$infos["heure_min"].':00:00\'';

		$result = $this->db->query($requete);

		$listePropose = array();

		while($propose = $result->fetch(PDO::FETCH_OBJ)){
			$listePropose[] = new Propose($propose);
		}

		return $listePropose;

	}

	public function getVilDepart($propose){
		$requete = 'SELECT vil_nom
					FROM ville
					WHERE vil_num IN
						(SELECT CASE '.$propose->getSens()
						.' WHEN 0 THEN vil_num1
						ELSE vil_num2 END AS vil_num
						FROM parcours 
						WHERE par_num = '.$propose->getParNum()
						.')';

		$result = $this->db->query($requete);

		return $result->fetch(PDO::FETCH_OBJ)->vil_nom;
	}


	public function getVilArrivee($propose){
		$requete = 'SELECT vil_nom
					FROM ville
					WHERE vil_num IN
						(SELECT CASE '.$propose->getSens()
						.' WHEN 0 THEN vil_num2
						ELSE vil_num1 END AS vil_num
						FROM parcours 
						WHERE par_num = '.$propose->getParNum()
						.')';

		$result = $this->db->query($requete);

		return $result->fetch(PDO::FETCH_OBJ)->vil_nom;
	}


	public function getNomCovoitureur($propose){
		$requete = 'SELECT CONCAT(per_prenom, \' \', per_nom) AS nomComplet
					FROM personne
					WHERE per_num = '.$propose->getPerNum();

		$result = $this->db->query($requete);

		return $result->fetch(PDO::FETCH_OBJ)->nomComplet;
	}


	public function getInfosAvis($propose){
		$requete = 'SELECT moy_avis, avi_comm
					FROM avis, 
						(SELECT AVG(avi_note) AS moy_avis
						FROM avis
						WHERE per_num ='.$propose->getPerNum()
						.') T1
					WHERE per_per_num ='.$propose->getPerNum()
					.' AND avi_date >= ALL
						(SELECT avi_date 
						FROM avis
						WHERE per_num ='.$propose->getPerNum()
						.')';

		$result = $this->db->query($requete);

		$tab = $result->fetch(PDO::FETCH_ASSOC);

		if (empty($tab)){
			return "Pas d'avis";
		}else{
			return 'Moyenne des avis : '.number_format($tab["moy_avis"],1,'.',' ')."\nDernier avis : ".$tab["avi_comm"];
		}
	}

}

?>