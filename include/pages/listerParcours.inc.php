<h1>Liste des parcours</h1>


<?php
  $pdo = new Mypdo();
  $manager = new ParcoursManager($pdo);
  $nb = $manager->nbParcours();
  echo "<p>Actuellement $nb->nbParcours parcours sont enregistrés</p>";

  $liste = $manager->getList();

?>

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
    <td><?php echo $parcours->getVille1() ?></td>
    <td><?php echo $parcours->getVille2() ?></td>
    <td><?php echo $parcours->getParKm() ?></td>
  </tr>
  <?php
  }
?>

</table>
