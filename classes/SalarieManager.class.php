<?php
class SalarieManager{
	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function insert($salarie){

		$requete = $this->db->prepare('INSERT INTO salarie (per_num, sal_telprof, fon_num)
		VALUES(:per_num, :sal_telprof, :fon_num);');

		$requete->bindValue(':per_num', $salarie->getPerNum());
		$requete->bindValue(':sal_telprof', $salarie->getTelprof());
		$requete->bindValue(':fon_num', $salarie->getFonNum());

		$result = $requete->execute();

		return $result;
	}

}
?>
