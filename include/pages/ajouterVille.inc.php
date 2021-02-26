
<h1>Ajouter une ville</h1>

<?php
if (empty($_POST["vil_nom"])) {
    ?>
<form id="ajouterVille" name="ajouterVille" action="#" method="POST">
	<label for="vil_nom"> Nom : </label> 
    <input id="vil_nom" name="vil_nom" type="text" required> 
    <input type="submit" value="Valider">
</form>


<?php
} else {
    $pdo = new Mypdo();
    $manager = new VilleManager($pdo);
    $ville = new Ville($_POST);

    if ($manager->insert($ville)) {
        ?>
        <div class="resultatRequete">
            <img src="image/valid.png">
            <p> La ville <?php echo $ville->getNom() ?> a été ajouté </p>
        </div>
<?php
    } else {
        ?>
        <div class="resultatRequete">
            <img src="image/erreur.png">
            <p>Quelquechose s'est mal passé lors de l'insertion</p>
        </div>
<?php
    }
}
?>
