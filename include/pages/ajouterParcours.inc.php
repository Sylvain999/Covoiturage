<h1>Ajouter un parcours</h1>


<?php
  $pdo = new Mypdo();

  if (empty($_POST["vil_num1"])){

  $manager = new VilleManager($pdo);

  $listeVilles = $manager->getList();
?>

<form id="AjouterParcours" name="AjouterParcours" method="POST">
  <label>Ville 1 : </label>
  <select id="vil_num1" name="vil_num1">
  <?php
  foreach($listeVilles as $ville){
    echo "<option value=\"".$ville->getNum()."\">".$ville->getNom()."</option>";
  }

   ?>

  </select>

  <label>Ville 2 : </label>
  <select id="vil_num2" name="vil_num2">
    <?php
    foreach($listeVilles as $ville){
      echo "<option value=\"".$ville->getNum()."\">".$ville->getNom()."</option>";
    }
     ?>
  </select>

  <label>Nombre de kilomètre(s)</label>
  <input type="number" id="par_km" name="par_km" required>

  <br>

  <input type=submit value="Valider">

</form>

<?php
}else{

  $manager = new ParcoursManager($pdo);
  $parcours = new Parcours($_POST);

  $result = $manager->inserer($parcours);

  if($result){?>
    <img src="image/valid.png">
    <?php
    echo "<p> le parcours a été ajouté </p>";
  }else{ ?>
    <img src="image/erreur.png">
    <?php
    echo "<p> quelquechose s'est mal passé </p>";
  }
}
?>
