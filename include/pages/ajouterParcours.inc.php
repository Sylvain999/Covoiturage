<h1>Ajouter un parcours</h1>


<?php
  $pdo = new Mypdo();

  $manager = new VilleManager($pdo);

  $listeVilles = $manager->getList();
?>

<form action="#" id="AjouterParcours" name="AjouterParcours" method="POST">
  <label for="vil_num1">Ville 1 : </label>
  <select id="vil_num1" name="vil_num1">
  <?php
  foreach($listeVilles as $ville){
    ?>
    <option value="<?php echo $ville->getNum() ?>"> <?php echo $ville->getNom() ?> </option>
    <?php
  }

   ?>

  </select>

  <label for="vil_num2" >Ville 2 : </label>
  <select id="vil_num2" name="vil_num2">
    <?php
    foreach($listeVilles as $ville){
    ?>
    <option value="<?php echo $ville->getNum() ?>"> <?php echo $ville->getNom() ?> </option>
    <?php
    }
     ?>
  </select>

  <label for="par_km">Nombre de kilomètre(s)</label>
  <input type="number" id="par_km" name="par_km" required>

  <br>

  <input type=submit value="Valider">

</form>

<?php
if (!empty($_POST["vil_num1"])){

  $managerParcours = new ParcoursManager($pdo);
  $parcours = new Parcours($_POST);

  if($managerParcours->canInsertParcours($parcours)){
      $result = $managerParcours->insert($parcours);

      if($result){?>
        <div class="resultatRequete">
          <img src="image/valid.png">
          <p> Le parcours a été ajouté </p>
        </div>

        <?php
      }else{ ?>
        <div class="resultatRequete">
          <img src="image/erreur.png">
          <p>Quelquechose s'est mal passé lors de l'insertion... </p>
        </div>
      <?php
      }
  }else{
      ?>
      <div class="resultatRequete">
        <img src="image/erreur.png">
        <p>Ce parcours ne peut pas être inséré</p>
      </div>
      <p>Rappel : On ne peut insérer un parcours exisant déjà, ni un parcours amenant à la même ville</p>

      <?php
  }

  
}
?>
