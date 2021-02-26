<?php
class SalarieManager extends PersonneManager{

	public function insert($salarie){
		if(!parent::insert($salarie)){
			return false;
		}

		$per_num = $this->db->lastInsertId();

		$requete = $this->db->prepare('INSERT INTO salarie (per_num, sal_telprof, fon_num)
		VALUES(:per_num, :sal_telprof, :fon_num);');

		$requete->bindValue(':per_num', $per_num);
		$requete->bindValue(':sal_telprof', $salarie->getTelprof());
		$requete->bindValue(':fon_num', $salarie->getFonNum());

		$result = $requete->execute();

		return $result;
	}

	public function update($salarie){
		if(!parent::update($salarie)){
			return false;
		}

		$requete = $this->db->prepare('UPDATE salarie SET sal_telprof=:sal_telprof, fon_num=:fon_num 
		WHERE per_num=:per_num;');

		$requete->bindValue(':per_num', $salarie->getNum());
		$requete->bindValue(':sal_telprof', $salarie->getTelprof());
		$requete->bindValue(':fon_num', $salarie->getFonNum());

		$result = $requete->execute();

		return $result;
	}

	public function delete($num){
		$requete = 'DELETE FROM salarie WHERE per_num='.$num;
		if (!$this->db->query($requete)){
			return false;
		}
		return parent::delete($num);
	}


	public function getSalarie($num){
		$requete = "SELECT p.per_num, per_nom, per_prenom,per_mail, per_tel, sal_telprof, fon_num
		FROM salarie s INNER JOIN personne p ON p.per_num = s.per_num
		WHERE p.per_num =$num";

		$result = $this->db->query($requete);

		return new Salarie($result->fetch(PDO::FETCH_OBJ));

	}


	public function getFonLibelle($fon_num){
		$requete = "SELECT fon_libelle
		FROM salarie s INNER JOIN fonction f ON s.fon_num = f.fon_num
		WHERE s.fon_num = $fon_num";

		$result = $this->db->query($requete);

		$tab = $result->fetch(PDO::FETCH_OBJ);
		
		return $tab->fon_libelle;
	}

}
?>
