
<h1>Proposer un trajet</h1>


<?php

    $pdo = new Mypdo();
    $managerParcours = new ParcoursManager($pdo);

    if(empty($_POST["numVille1"]) && empty($_POST["par_num"])){


?>

<form id="proposerTrajetVilleDepart" name="proposerTrajetVilleDepart" action="#" method="POST"> 
    <label for="numVille1">Ville de départ</label>
    <select id="numVille1" name="numVille1" 
        onChange='javascript:document.getElementById("proposerTrajetVilleDepart").submit()'>
        <option value="undefined">--Choisissez la ville de départ--</option>
        <?php 
            foreach($managerParcours->getListVille() as $ville){
        ?>
        <option value="<?php echo $ville->getNum() ?>"> <?php echo $ville->getNom()?> </option>
        <?php
            }
        ?>     
    </select>

</form>

<?php
    }else if(!empty($_POST["numVille1"]) && empty($_POST["par_num"])) {
        $managerVille = new VilleManager($pdo);
        $_SESSION["vil_num1"] = $_POST["numVille1"];
        $ville1 = $managerVille->getVilleById($_POST["numVille1"]);
?>


<form action="#" name="proposerTrajet" id="proposerTrajet" method="POST">
    <div class="grid_display">
    <b>Ville de départ :</b> 
    <b><?php echo $ville1->getNom(); ?></b>

    <label for="numVille2">Ville d'arrivée</label>

    <?php $managerParcours->getListVilleParcoursWith($ville1->getNum()) ?>

    <select id="par_num" name="par_num">
        <?php 
            foreach($managerParcours->getListVilleParcoursWith($ville1->getNum()) as $key => $ville){
        ?>
        <option value="<?php echo $key ?>"> <?php echo $ville->getNom()?> </option>
        <?php
            }
        ?>     
    </select>

    <label for="pro_date">Date de départ</label>
    <input id="pro_date" name="pro_date" type="date" min="<?php echo date("Y-m-d") ?>" 
        value="<?php echo date("Y-m-d") ?>" required>
    
    <label for="pro_time">Heure de départ</label>
    <input id="pro_time" name="pro_time" type="time" value="<?php echo date("H:i:s") ?>" step="1" required>


    <label for="pro_place">Nombre de places</label>
    <input id="pro_place" name="pro_place" type="number" required>

    </div>


    <input type="submit" value="Valider">

</form>

<?php
    }else{

        $managerPropose = new ProposeManager($pdo);
        $managerPersonne = new PersonneManager($pdo);
        $elementsPropose = $_POST;
        $elementsPropose["per_num"] = $_SESSION["utilisateur"]->getNum();
        $elementsPropose["pro_sens"] = $managerParcours->getSensVilleByNum($_POST["par_num"],$_SESSION["vil_num1"]);
        
        $result = $managerPropose->inserer(new Propose($elementsPropose));


        if ($result) {
            ?> <p> tout s'est bien passé </p> <?php
        }else{
            ?> <p> quelque chose s'est mal passé </p> <?php
        }

    }
?>