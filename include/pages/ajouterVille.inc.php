
<h1>Ajouter une ville</h1>

<?php
if (empty($_POST["vil_nom"])){?>
<form id="ajouterVille" name="ajouterVille" action="#" method="POST">
  <div>
    <label> Nom : </label>
    <input id="vil_nom" name="vil_nom" type="text" required>
    <input type="submit" value="Valider">
  </div>
</form>


<?php }else{
  $pdo = new Mypdo();
  $manager = new VilleManager($pdo);
  $ville = new Ville($_POST);

  echo $ville->getNom();

  $retour = $manager->inserer($ville);

  if($retour){?>
    <img src="image/valid.png">
    <?php
    echo "<p> la ville ".$_POST["vil_nom"]." a été ajouté </p>";
  }else{
    ?>
    <img src="image/erreur.png">
    <?php
    echo "<p> quelquechose s'est mal passé </p>";
  }
}
?>
