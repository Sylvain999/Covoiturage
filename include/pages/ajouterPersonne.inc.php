<?php
if (empty($_POST["per_nom"]) && empty($_POST["div_num"]) && empty($_POST["fon_num"])){
 ?>

<h1>Ajouter une personne</h1>


<form id="ajoutPersonne" name="ajoutPersonne" method="POST">
	<label>Nom : </label>
	<input type = "text" id="per_nom" name="per_nom" required>

	<label>Prenom : </label>
	<input type="text" id="per_prenom" name="per_prenom" required>

	<br>

	<label>Téléphone : </label>
	<input type="tel" id="per_tel" name="per_tel" required>

	<label>Mail : </label>
	<input type="email" id="per_mail" name="per_mail" required>

	<br>

	<label>Login : </label>
	<input autocomplete="off" type="text" id="per_login" name="per_login" required>

	<label>Mot de Passe : </label>
	<input autocompete="off" type="password" id="per_pwd" name="per_pwd" required>

	<br>

	<p> Catégorie : </p>
	<input type="radio" id="etudiant" name="categorie" value="etudiant" checked>
	<label for="etudiant">Etudiant</label>

	<input type="radio" id="personnel" name="categorie" value="personnel">
	<label for="personnel">Personnel</label>

	<br>

	<input type="submit" value="Valider">

</form>


<?php
}else if(!empty($_POST["per_nom"]) && empty($_POST["div_num"]) && empty($_POST["fon_num"])){
	$pdo = new Mypdo();
	$managerPersonne = new PersonneManager($pdo);
	$pers = new Personne($_POST);

	if(!$managerPersonne->insert($pers)){
		echo "<p> Quelque chose s'est mal passé </p>";
	}else{
		$_SESSION['per_num'] = $pdo->lastInsertId();

		if ($_POST["categorie"] == "etudiant"){
			?>
			<h1>Ajouter un étudiant</h1>

			<form id="ajoutEtudiant" name="ajoutEtudiant" method="POST">
				<label>Année :</label>


				<select id="div_num" name="div_num">
					<?php
					$managerDivision = new DivisionManager($pdo);
					$liste = $managerDivision->getList();
					foreach($liste as $division){
						echo '<option value="'.$division->getNum().'">'.$division->getNom().'</option>';
					}
					?>
				</select>

				<label>Département</label>
				<select id="dep_num" name="dep_num">
					<?php
					$managerDepartement = new DepartementManager($pdo);
					$liste = $managerDepartement->getList();
					foreach($liste as $departement){
						echo '<option value="'.$departement->getNum().'">'.$departement->getNom().'</option>';
					}
					?>
				</select>

				<input type="submit" value="Valider">

			</form>

			<?php
		}else{
			?>
			<h1>Ajouter un étudiant</h1>

			<form id="ajoutSalarie" name="ajoutSalarie" method="POST">
				<label>Téléphone Professionnel :</label>
				<input type="tel" id="sal_telprof" name="sal_telprof">

				<label>Fonction :</label>
				<select id="fon_num" name="fon_num">
					<?php
					$managerFonction = new FonctionManager($pdo);
					$liste = $managerFonction->getList();
					foreach($liste as $fonction){
						echo '<option value="'.$fonction->getNum().'">'.$fonction->getLibelle().'</option>';
					}
					?>
				</select>

				<input type="submit" value="Valider">

			</form>
			<?php
		}
	}

}else if(empty($_POST["per_nom"]) && !empty($_POST["div_num"]) && empty($_POST["fon_num"])){
	$pdo = new Mypdo();
	$managerEtudiant = new EtudiantManager($pdo);
	$etudiant = new Etudiant($_POST);
	$etudiant->setPerNum($_SESSION['per_num']);

	if(!$managerEtudiant->insert($etudiant)){
		echo "<p>Oups, quelque chose s'est mal passé</p>";
	}else{
		echo "<p>L'étudiant a été ajouté</p>";
	}

}else{
	$pdo = new Mypdo();
	$managerSalarie = new SalarieManager($pdo);
	$salarie = new Salarie($_POST);
	$salarie->setPerNum($_SESSION['per_num']);

	if(!$managerSalarie->insert($salarie)){
		echo "<p>Oups, quelque chose s'est mal passé</p>";
	}else{
		echo "<p>Le salarié a été ajouté</p>";
	}

}
 ?>
