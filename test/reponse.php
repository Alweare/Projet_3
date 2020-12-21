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

        if (!empty($_POST['username'])) 
        {
            include '../base.php';
            $username = htmlspecialchars($_POST['username']);
            $bdd = $bdd->prepare('SELECT question, reponse FROM account WHERE username = ?');
            $bdd->execute(array($username));
            $test = $bdd->fetch();
            if(!empty($test['question']))
            {
                ?>
                <div class="connexion">
                    <form action="nouveau_password.php" method="POST"> 

                    <p>
                        Question secrète :
                    <?php echo $test['question']; ?>
                    </p>
                        <p>
                            <label>
                                Reponse :

                                <input type="text" name="reponse" />
                                <input type="hidden" value="<?php echo $username ;?>" name="username"/>
                            
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
                echo 'Problème';
            }
        }
      ?>  

    </body>
</html>