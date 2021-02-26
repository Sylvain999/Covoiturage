<h1>Rechercher un trajet</h1>

<?php
$pdo = new Mypdo();
$managerParcours = new ParcoursManager($pdo);

if (empty($_POST["numVille1"]) && empty($_POST["par_num"])) {

    $managerParcours->getListVilleDepart()?>
    

<form id="rechercherTrajetVilleDepart"
	name="rechercherTrajetVilleDepart" action="#" method="POST">
	<label for="numVille1">Ville de départ</label> 
    <select id="numVille1"
		name="numVille1"
		onChange='javascript:document.getElementById("rechercherTrajetVilleDepart").submit()'>
		<option value="undefined">--Choisissez la ville de départ--</option>
        <?php
    foreach ($managerParcours->getListVilleDepart() as $ville) {
        ?>
        <option value="<?php echo $ville->getNum() ?>"> <?php echo $ville->getNom()?> </option>
        <?php
    }
    ?>     
    </select>

</form>

<?php
} else if (! empty($_POST["numVille1"]) && empty($_POST["par_num"])) {
    $managerVille = new VilleManager($pdo);
    $_SESSION["vil_num1"] = $_POST["numVille1"];
    $ville1 = $managerVille->getVilleById($_POST["numVille1"]);
    ?>


<form action="#" name="rechercherTrajet" id="rechercherTrajet"
	method="POST">

    <div class=grid_display>

        <b>Ville de départ :</b> <p> <?php echo $ville1->getNom(); ?> </p>

        <label for="par_num">Ville d'arrivée</label>

        <?php $managerParcours->getListVilleParcoursWith($ville1->getNum()) ?>

        <select id="par_num" name="par_num">
            <?php
        foreach ($managerParcours->getListVilleParcoursWith($ville1->getNum()) as $key => $ville) {
            ?>
            <option value="<?php echo $key ?>"> <?php echo $ville->getNom()?> </option>
            <?php
        }
        ?>     
        </select>
        
        <label for="pro_date">Date de départ</label> 
        <input id="pro_date" name="pro_date" type="date"
            value="<?php echo date("Y-m-d") ?>" required> 
            
        <label for="precision">Précision</label>

        <select id="precision" name="precision">
            <option value="0">Ce jour</option>
            <option value="1">+/- 1 jour</option>
            <option value="2">+/- 2 jours</option>
            <option value="3">+/- 3 jours</option>
        </select>
        
        <label for="heure_min">A partir de</label> 
        <select id="heure_min" name="heure_min">
            <?php
        for ($i = 0; $i < 24; $i ++) {
            ?>
            <option value="<?php echo $i ?>"><?php echo $i."h" ?></option>
            <?php
        }
        ?>
        </select>
    </div>
    
    <input type="submit" value="Valider">

</form>

<?php
} else {

    $managerPropose = new ProposeManager($pdo);

    $infos = $_POST;
    $infos["vil_num1"] = $_SESSION["vil_num1"];

    $liste = $managerPropose->getListProposeWithParcours($infos);

    if (empty($liste)) {
    ?>

<div class="resultatRequete">
    <img src="image/erreur.png">
    <p>Désolé, pas de trajet disponible !</p>
</div>

<?php
    } else {
        ?>
<table>

	<tr>
		<th>Ville départ</th>
		<th>Ville arrivée</th>
		<th>Date départ</th>
		<th>Heure départ</th>
		<th>Nombre de place(s)</th>
		<th>Nom du covoitureur</th>
	</tr>

    <?php
        foreach ($liste as $propose) {
            ?>

    <tr>
		<td><?php echo $managerPropose->getVilDepart($propose) ?></td>
		<td><?php echo $managerPropose->getVilArrivee($propose) ?></td>
		<td><?php echo $propose->getDate() ?></td>
		<td><?php echo $propose->getTime() ?></td>
		<td><?php echo $propose->getPlace() ?></td>
		<td><a href="<?php echo "?page=2&numPers=".$propose->getPerNum() ?>"
			title="<?php echo $managerPropose->getInfosAvis($propose) ?>">
                <?php echo $managerPropose->getNomCovoitureur($propose) ?>
            </a></td>
	</tr>
    <?php
        }
        ?>


</table>
<?php
    }
}

?>