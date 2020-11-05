<h1>Liste des villes</h1>


<?php
  $pdo = new Mypdo();
  $manager = new VilleManager($pdo);
  $nb = $manager->nbVilles();
  echo "<p>Actuellement $nb->nbVilles villes sont enregistrés</p>";

  $liste = $manager->getList();

?>

<table>
  <tr>
    <th>idVille</th>
    <th>nomVille</th>
  </tr>
<?php
  foreach($liste as $ville){
    ?>
    <tr>
      <td><?php echo $ville->getNum() ?></td>
      <td><?php echo $ville->getNom() ?></td>
    </tr>
  <?php
  }
?>

</table>
