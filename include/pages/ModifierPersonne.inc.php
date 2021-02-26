<?php
$pdo = new Mypdo();
$managerPersonne = new PersonneManager($pdo);

if (empty($_GET["numPers"]) && empty($_POST["per_nom"])){

$liste = $managerPersonne->getList();

?>

<h1>Modifier Personne</h1>

<table>
  <tr>
    <th> Numero </th>
    <th> Nom </th>
    <th> Prenom </th>
  </tr>
  <?php
  foreach($liste as $pers){
  ?>
  <tr>
    <td>
      <a href= "<?php echo "index.php?page=3&numPers=".$pers->getNum() ?>"> <?php echo $pers->getNum() ?> </a>
    </td>
    <td> <?php echo $pers->getNom() ?> </td>
    <td> <?php echo $pers->getPrenom() ?> </td>
  </tr>
  <?php
  }
  ?>
</table>


<?php
}else if(!empty($_GET["numPers"]) && empty($_POST["per_nom"])){
    
    $_SESSION["numPers"] = $_GET["numPers"];

    if($managerPersonne->getCategorie($_GET["numPers"]) === "etudiant"){
        $managerEtudiant = new EtudiantManager($pdo);
        $etudiant = new Etudiant($managerEtudiant->getEtudiant($_GET["numPers"]));
        
?>

<h1>Modifier Étudiant</h1>

<form id="modifierEtudiant" name="modifierEtudiant" action="#" method="POST">
  <div class="grid_display">
		<label for="per_nom">Nom : </label>
		<input value="<?php echo $etudiant->getNom() ?>" type = "text" id="per_nom" name="per_nom" required>

		<label>Prenom : </label>
		<input value="<?php echo $etudiant->getPrenom() ?>" type="text" id="per_prenom" name="per_prenom" required>

		<label>Téléphone : </label>
		<input value="<?php echo $etudiant->getTel() ?>" type="tel" id="per_tel" name="per_tel" 
			pattern="[0-9]{10}" placeholder="ex : 0612345678" required>

		<label>Mail : </label>
		<input value="<?php echo $etudiant->getMail() ?>" type="email" id="per_mail" name="per_mail" required>

		<label>Année :</label>

		<select id="div_num" name="div_num">
			<?php
			$managerDivision = new DivisionManager($pdo);
			$liste = $managerDivision->getList();
			foreach($liste as $division){ ?>
				<option <?php
        if($division->getNum() == $etudiant->getDivNum()){
          ?> selected <?php
        }
        ?>value="<?php echo $division->getNum() ?>"> <?php echo $division->getNom() ?> </option>

			<?php
			}
			?>
		</select>

		<label>Département :</label>
		<select id="dep_num" name="dep_num">
			<?php
			$managerDepartement = new DepartementManager($pdo);
			$liste = $managerDepartement->getList();
			foreach($liste as $departement){
				?>
				<option <?php
        if($departement->getNum() == $etudiant->getDepNum()){
          ?> selected <?php
        }
        ?>value="<?php echo $departement->getNum() ?>"> <?php echo $departement->getNom() ?></option>

				<?php
			}
			?>
		</select>

	</div>

  <input type="submit" value="Valider">

</form>


<?php

    }else{

      $managerEtudiant = new SalarieManager($pdo);
      $salarie = new Salarie($managerEtudiant->getSalarie($_GET["numPers"]));
        
?>

<h1>Modifier Salarié</h1>

<form id="modifierSalarie" name="modifierSalarie" action="#" method="POST">
  <div class="grid_display">
		<label for="per_nom">Nom : </label>
		<input value="<?php echo $salarie->getNom() ?>" type = "text" id="per_nom" name="per_nom" required>

		<label>Prenom : </label>
		<input value="<?php echo $salarie->getPrenom() ?>" type="text" id="per_prenom" name="per_prenom" required>

		<label>Téléphone : </label>
		<input value="<?php echo $salarie->getTel() ?>" type="tel" id="per_tel" name="per_tel" 
			pattern="[0-9]{10}" placeholder="ex : 0612345678" required>

		<label>Mail : </label>
		<input value="<?php echo $salarie->getMail() ?>" type="email" id="per_mail" name="per_mail" required>

		<label>Téléphone Professionnel :</label>
    <input value="<?php echo $salarie->getTelProf() ?>" type="tel" id="sal_telprof" pattern="[0-9]{10}" 
      placeholder="ex : 0612345678" name="sal_telprof" required>

    <label>Fonction :</label>
    <select id="fon_num" name="fon_num">
      <?php
      $managerFonction = new FonctionManager($pdo);
      $liste = $managerFonction->getList();
      foreach($liste as $fonction){
        ?>
				<option <?php
        if($fonction->getNum() == $salarie->getFonNum()){
          ?> selected <?php
        }
        ?>
        value="<?php echo $fonction->getNum() ?>"> <?php echo $fonction->getLibelle() ?></option>
        <?php
      }
      ?>
    </select>

	</div>

  <input type="submit" value="Valider">

</form>

<?php
    }

}else{
    if($managerPersonne->getCategorie($_SESSION["numPers"]) === "etudiant"){
        $managerEtudiant = new EtudiantManager($pdo);
        $elementsEtudiants = $_POST;
        $elementsEtudiants["per_num"] = $_SESSION["numPers"];
        $etudiant = new Etudiant($elementsEtudiants);
        
        $resultat = $managerEtudiant->update($etudiant);
        
       
    }else{
        $managerSalarie = new SalarieManager($pdo);
        $elementsSalarie = $_POST;
        $elementsSalarie["per_num"] = $_SESSION["numPers"];
        $salarie = new Salarie($elementsSalarie);
        
        $resultat = $managerSalarie->update($salarie);
    }
    
    if($resultat){
        ?><p>Tout s'est bien passé</p><?php
    }else{
        ?><p>Quelque chose s'est mal passé lors de la modification</p><?php
    }
  
  ?>


<?php
}
?>
