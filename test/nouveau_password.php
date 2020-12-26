<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../style.css" />
        
        <title>GBAFConnect</title>
    </head>
    <body> 
        <header>
            <div class="header_border">
                <img src="../images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf"/>  
            </div>
        </header>
        <?php

        if (!empty($_POST['username'])) {
            include '../base.php';
            $username = htmlspecialchars($_POST['username']);
            $bdd = $bdd->prepare('SELECT question, reponse FROM account WHERE username = ?');
            $bdd->execute(array($username));
            $test = $bdd->fetch();
        
            if (!empty($_POST['reponse']) && $_POST['reponse'] == $test['reponse']) 
            {
                
                
                ?>
                <div class="connexion">
                    <form action="insert_mdp.php" method="POST"> 

                        
                        <?php echo $username; ?>
                        
                            <label>
                                Nouveau mot de passe :

                                <input type="password" name="password" />
                                <input type="hidden" value="<?php echo $username; ?>" name="username"/>
                                
                            
                            </label>

                        </p>
                        <p>
                            <input type="submit" value="Envoyer">
                        </p>

                    </form>

                </div>
            <?php
            }
            else 
            {
                echo 'Erreur <a href="../login.php" class="bouton_retour">Réessayez</a>';
            }
            
        }
        else
        {
            echo '1er if';
        }
        ?>

    </body>
</html>