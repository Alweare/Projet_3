<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
    </head>
    <body>
        <?php
        include 'base.php';
        $profil = $bdd->prepare('SELECT nom, prenom, username, password, question, reponse FROM account WHERE id_user = ?');
        $profil->execute(array($_SESSION['id']));
        $donnees = $profil->fetch();
        ?>
       <div class="info">
        <p>
                Nom : <?php echo $donnees['nom'];?>   <a href="profil.php?modif=1">Modifier</a>
                <?php 
                $modif = intval($_GET['modif']);
                if (isset($modif) && !empty($modif) && $modif == 1) {
                    ?>
                <form action="modifprofil.php" method="POST">
                    <label>
                        Nom :
                        <input type="text" name="modif" />
                    </label>
                    <input type="hidden" value="1" name="indice" />
                    <input type="submit" name="Valider" />
                </form>
                <?php
                }


                ?>

            </p>
            <p>
                Prenom : <?php echo $donnees['prenom'];?>  <a href="profil.php?modif=2">Modifier</a>
                <?php 
                $modif = intval($_GET['modif']);
                if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 2) {
                    ?>
                <form action="modifprofil.php" method="POST">
                    <label>
                        Prénom :
                        <input type="text" name="modif_prenom" />
                    </label>
                    <input type="hidden" value="2" name="indice"/>
                    <input type="submit" name="Valider" />
                </form>
                <?php
                }
                ?>

            </p>
            <p>
                Username : <?php echo $donnees['username'];?>  <a href="profil.php?modif=3">Modifier</a>
                <?php 
                $modif = intval($_GET['modif']);
                if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 3) 
                {
                    ?>
                <form action="modifprofil.php" method="POST">
                    <label>
                        Nom :
                        <input type="text" name="modif_username" />
                    </label>
                    <input type="submit" name="Valider" />
                    <input type="hidden" value="3" name="indice"/>
                </form>
                <?php
                }


                ?>

            </p>
            <p>
                Mot de passe : ****** <a href="profil.php?modif=6">Modifier</a>
                <?php 
                $modif = intval($_GET['modif']);
                if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 6) 
                {
                    ?>
                <form action="modifprofil.php" method="POST">
                    <label>
                        Nouveau mot de passe :
                        <input type="password" name="modif_password" />
                    </label>
                    <input type="hidden" value="6" name="indice"/>
                    <input type="submit" name="Valider" />
                </form>
                <?php
                }


                ?>

            </p>

            <p>
                Question secrète : <?php echo $donnees['question'];?> <a href="profil.php?modif=4">Modifier</a>
                <?php 
                $modif = intval($_GET['modif']);
                if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 4) 
                {
                    ?>
                <form action="modifprofil.php" method="POST">
                    <label>
                        Question :
                        <input type="text" name="modif_question" />
                    </label>
                    <input type="hidden" value="4" name="indice"/>
                    <input type="submit" name="Valider" />
                </form>
                <?php
                }


                ?>
                

            </p>
            <p>
                Réponse secrète : <?php echo $donnees['reponse'];?>  <a href="profil.php?modif=5">Modifier</a>
                <?php 
                $modif = intval($_GET['modif']);
                if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 5) 
                {
                    ?>
                <form action="modifprofil.php" method="POST">
                    <label>
                        Nom :
                        <input type="text" name="modif_reponse" />
                    </label>
                    <input type="hidden" value="5" name="indice"/>
                    <input type="submit" name="Valider" />
                </form>
                <?php
                }


                ?>

            </p>
       </div>
   
    </body>
</html>