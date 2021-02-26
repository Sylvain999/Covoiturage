<h1>Liste des parcours</h1>


<?php
  $pdo = new Mypdo();
  $manager = new ParcoursManager($pdo);

  $liste = $manager->getList();

?>

<p>Actuellement <?php echo $manager->nbParcours() ?> parcours sont enregistrés</p>

<table>
  <tr>
    <th>idParcours</th>
    <th>numVille1</th>
    <th>numVille2</th>
    <th>KmParcours</th>
  </tr>
<?php
  foreach($liste as $parcours){
    ?>
  <tr>
    <td><?php echo $parcours->getParNum() ?></td>
    <td><?php echo $manager->getNomVille1($parcours) ?></td>
    <td><?php echo $manager->getNomVille2($parcours) ?></td>
    <td><?php echo $parcours->getParKm() ?></td>
  </tr>
  <?php
  }
?>

</table>
