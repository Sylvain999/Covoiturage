<?php
$pdo = new Mypdo();
$managerPersonne = new PersonneManager($pdo);


if(!empty($_GET["numPers"]) && $managerPersonne->contains($_GET["numPers"])){
    if ($managerPersonne->getCategorie($_GET["numPers"]) === "etudiant"){
        $managerEtudiant = new EtudiantManager($pdo);
        $managerEtudiant->delete($_GET["numPers"]);
    }else{
        $managerSalarie = new SalarieManager($pdo);
        $managerSalarie->delete($_GET["numPers"]);
    }
}


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
    <td> <?php echo $pers->getNum() ?> </td>
    <td> <?php echo $pers->getNom() ?> </td>
    <td> <?php echo $pers->getPrenom() ?> </td>
    <td> <a href= "<?php echo "index.php?page=4&numPers=".$pers->getNum() ?>"> Supprimer </a> </td>
  </tr>
  <?php
  }
  ?>
</table>
