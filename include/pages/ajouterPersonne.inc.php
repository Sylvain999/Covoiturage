<?php
if (empty($_POST["per_nom"]) && empty($_POST["div_num"]) && empty($_POST["fon_num"])){
 ?>

<h1>Ajouter une personne</h1>


<form action="#" id="ajoutPersonne" name="ajoutPersonne" method="POST">
	<div class="grid_display">
		<label for="per_nom">Nom : </label>
		<input type = "text" id="per_nom" name="per_nom" required>

		<label for="per_prenom">Prenom : </label>
		<input type="text" id="per_prenom" name="per_prenom" required>

		<label for="per_tel">Téléphone : </label>
		<input type="tel" id="per_tel" name="per_tel" 
			pattern="[0-9]{10}" placeholder="ex : 0612345678" required>

		<label for="per_mail">Mail : </label>
		<input type="email" id="per_mail" name="per_mail" required>

		<label for="per_login">Login : </label>
		<input autocomplete="off" type="text" id="per_login" name="per_login" required>

		<label for="per_pwd">Mot de Passe : </label>
		<input autocompete="off" type="password" id="per_pwd" name="per_pwd" required>
	</div>	

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
	$_POST["per_pwd"] = sha1(sha1($_POST["per_pwd"]).SALT);
	$_SESSION["personne"] = $_POST;

	if ($_POST["categorie"] == "etudiant"){
	?>

	<h1>Ajouter un étudiant</h1>

	<form action="#" id="ajoutEtudiant" name="ajoutEtudiant" method="POST">
		<label for="div_num">Année :</label>


		<select id="div_num" name="div_num">
			<?php
			$managerDivision = new DivisionManager($pdo);
			$liste = $managerDivision->getList();
			foreach($liste as $division){ ?>
				<option value="<?php echo $division->getNum() ?>"> <?php echo $division->getNom() ?> </option>

			<?php
			}
			?>
		</select>

		<label for="dep_num">Département :</label>
		<select id="dep_num" name="dep_num">
			<?php
			$managerDepartement = new DepartementManager($pdo);
			$liste = $managerDepartement->getList();
			foreach($liste as $departement){
				?>
				<option value="<?php echo $departement->getNum() ?>"> <?php echo $departement->getNom() ?></option>

				<?php
			}
			?>
		</select>

		<input type="submit" value="Valider">

	</form>

<?php
		}else{
?>
<h1>Ajouter un salarie</h1>

<form action="#" id="ajoutSalarie" name="ajoutSalarie" method="POST">
	<label for="sal_telprof">Téléphone Professionnel :</label>
	<input type="tel" id="sal_telprof" pattern="[0-9]{10}" placeholder="ex : 0612345678" name="sal_telprof" required>

	<label for="fon_num">Fonction :</label>
	<select id="fon_num" name="fon_num">
		<?php
		$managerFonction = new FonctionManager($pdo);
		$liste = $managerFonction->getList();
		foreach($liste as $fonction){
			?>
			<option value="<?php echo $fonction->getNum() ?>"><?php echo $fonction->getLibelle() ?></option>
			<?php
		}
		?>
	</select>

	<input type="submit" value="Valider">

</form>
<?php
	}

}else if(empty($_POST["per_nom"]) && !empty($_POST["div_num"]) && empty($_POST["fon_num"])){
	$pdo = new Mypdo();
	$managerEtudiant = new EtudiantManager($pdo);
	$etudiant = new Etudiant(array_merge($_POST, $_SESSION["personne"]));

	if(!$managerEtudiant->insert($etudiant)){
		?>
		<div class="resultatRequete">
			<img src="image/erreur.png">
			<p>Oups, quelque chose s'est mal passé</p>
		</div>
		<?php
	}else{
		?>
		<div class="resultatRequete">
        	<img src="image/valid.png">
			<p>L'étudiant a été ajouté</p>
		</div>
		<?php
	}

}else{
	$pdo = new Mypdo();
	$managerSalarie = new SalarieManager($pdo);
	$salarie = new Salarie(array_merge($_POST, $_SESSION["personne"]));

	if(!$managerSalarie->insert($salarie)){
		?>
		<div class="resultatRequete">
        	<img src="image/erreur.png">
			<p>Oups, quelque chose s'est mal passé</p>
		</div>
		<?php
	}else{
		?>
		<div class="resultatRequete">
        	<img src="image/valid.png">
			<p>Le salarié a été ajouté</p>	
		</div>
		<?php
	}

}
 ?>
