<?php
$pdo = new Mypdo();
$managerPersonne = new PersonneManager($pdo);

if (empty($_GET["numPers"])){

$liste = $managerPersonne->getList();

?>

<h1>Liste des personnes enregistrées</h1>

<p>Actuellement <?php echo $managerPersonne->getNbPersonnes() ?> personnes enregistrées</p>

<table>
  <tr>
    <th> Numéro </th>
    <th> Nom </th>
    <th> Prénom </th>
  </tr>
  <?php
  foreach($liste as $pers){
  ?>
  <tr>
    <td>
      <a href="<?php echo "index.php?page=2&numPers=".$pers->getNum() ?>"> <?php echo $pers->getNum() ?> </a>
    </td>
    <td> <?php echo $pers->getNom() ?> </td>
    <td> <?php echo $pers->getPrenom() ?> </td>
  </tr>
  <?php
  }
  ?>
</table>


<?php
}else{

  if($managerPersonne->getCategorie($_GET["numPers"]) === "etudiant"){
    $managerEtudiant = new EtudiantManager($pdo);
    $etudiant = $managerEtudiant->getEtudiant($_GET["numPers"]);

?>

<h1>Détail sur l'étudiant <?php echo $etudiant->getNom() ?></h1>

<table>
  <tr>
    <th> Prénom </th>
    <th> Mail </th>
    <th> Tel </th>
    <th> Département </th>
    <th> Ville </th>
  </tr>
  <tr>
    <td> <?php echo $etudiant->getPrenom() ?> </td>
    <td> <?php echo $etudiant->getMail() ?> </td>
    <td> <?php echo $etudiant->getTel() ?> </td>
    <td> <?php echo $managerEtudiant->getDepNom($etudiant->getDepNum()) ?> </td>
    <td> <?php echo $managerEtudiant->getVilNom($etudiant->getDepNum()) ?> </td>
  </tr>
</table>

<?php
}else{
    $managerSalarie = new SalarieManager($pdo);
    $salarie = $managerSalarie->getSalarie($_GET["numPers"]);

?>

<h1>Détail sur le salarié <?php echo $salarie->getNom() ?></h1>


<table>
  <tr>
    <th> Prénom </th>
    <th> Mail </th>
    <th> Tel </th>
    <th> Tel pro </th>
    <th> Fonction </th>
  </tr>
  <tr>
    <td> <?php echo $salarie->getPrenom() ?> </td>
    <td> <?php echo $salarie->getMail() ?> </td>
    <td> <?php echo $salarie->getTel() ?> </td>
    <td> <?php echo $salarie->getTelProf() ?> </td>
    <td> <?php echo $managerSalarie->getFonLibelle($salarie->getFonNum()) ?> </td>
  </tr>
</table>

<?php

}
 ?>

<?php
}



 ?>
