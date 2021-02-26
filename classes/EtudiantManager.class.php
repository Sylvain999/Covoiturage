<?php
class EtudiantManager extends PersonneManager{

	public function insert($etudiant){
		if(!parent::insert($etudiant)){
			return false;
		}

		$per_num = $this->db->lastInsertId();

		$requete = $this->db->prepare('INSERT INTO etudiant (per_num, dep_num, div_num)
		VALUES(:per_num, :dep_num, :div_num);');

		$requete->bindValue(':per_num', $per_num);
		$requete->bindValue(':dep_num', $etudiant->getDepNum());
		$requete->bindValue(':div_num', $etudiant->getDivNum());

		return $requete->execute();

	}

	public function update($etudiant){
		if(!parent::update($etudiant)){
			return false;
		}

		$requete = $this->db->prepare('UPDATE etudiant SET dep_num=:dep_num, div_num=:div_num 
		WHERE per_num=:per_num;');

		$requete->bindValue(':per_num', $etudiant->getNum());
		$requete->bindValue(':dep_num', $etudiant->getDepNum());
		$requete->bindValue(':div_num', $etudiant->getDivNum());

		return $requete->execute();
	}


	public function delete($num){
		$requete = 'DELETE FROM etudiant WHERE per_num='.$num;
		if (!$this->db->query($requete)){
			return false;
		}
		return parent::delete($num);
	}

	public function getEtudiant($num){
		$requete = "SELECT p.per_num, per_nom, per_prenom, per_mail, per_tel, dep_num, div_num
		FROM etudiant e INNER JOIN personne p ON p.per_num = e.per_num
		WHERE p.per_num =$num";

		$result = $this->db->query($requete);

		return new Etudiant($result->fetch(PDO::FETCH_OBJ));

	}

	public function getDepNom($dep_num){
		$requete = "SELECT dep_nom
		FROM etudiant e INNER JOIN departement d ON e.dep_num = d.dep_num
		WHERE e.dep_num = $dep_num";

		$result = $this->db->query($requete);
		
		return $result->fetch(PDO::FETCH_OBJ)->dep_nom;
	}

	public function getVilNom($dep_num){
		$requete = "SELECT vil_nom
		FROM etudiant e INNER JOIN departement d ON e.dep_num = d.dep_num
						INNER JOIN ville v ON v.vil_num = d.vil_num
		WHERE e.dep_num = $dep_num";

		$result = $this->db->query($requete);
		
		return $result->fetch(PDO::FETCH_OBJ)->vil_nom;
	}

}
