
<h1>Pour vous connecter</h1>

<?php
    if(empty($_POST["utilisateur"])){
?>
<form action="#" id="connexion" name="connexion" method="POST">
    <div class="alignerColonne">
        <label for="utilisateur">Nom d'utilisateur</label>
        <input autocompete="off" type="text" id="utilisateur" name="utilisateur" required/>
        <label for="mdp">Mot de passe</label>
        <input autocompete="off" type="password" id="mdp" name="mdp" required />
        <?php
            $nombre1 = (int)rand(1,9);
            $nombre2 = (int)rand(1,9);
            $_SESSION["nombrePourConnexion"] = $nombre1 + $nombre2;
        ?>
        <div>
            <img src="image/nb/<?php echo $nombre1;  ?>.jpg">
            +
            <img src="image/nb/<?php echo $nombre2;  ?>.jpg">
            =
        </div>
        <input type="number" id="nombre" name="nombre" required/>
    </div>

    <input type="submit" value="Valider"/>
</form>

<?php
    }else{
        $pdo = new Mypdo();
        $managerPersonne = new PersonneManager($pdo);
        $personne = $managerPersonne->getPersonneByLoginAndPwd($_POST["utilisateur"], sha1(sha1($_POST["mdp"]).SALT)); 

        if(!$personne == null && $_POST["nombre"] == $_SESSION["nombrePourConnexion"]){
            header('Location: index.php');
            $_SESSION["utilisateur"] = $personne;
        }else{
            header('Location: index.php?page=11');
        }

        exit();
    }
?>