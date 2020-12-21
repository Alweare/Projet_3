
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="style.css" />
        
        <title>GBAFConnect</title>
    </head>
    <body> 
        <header>
            <div class="header_border">
                <img src="images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf"/>  
            </div>
        </header>
        <div class="connexion">
            <form action="verifconnexion.php" method="POST"> 

                <p>
                    <label>
                        Identifiant  :    

                    <input type="text" name="username" />
                    
                    </label>
                </p>
                <p>
                    <label>
                        Mot de passe :

                        <input type="password" name="password" />
                    
                    </label>

                </p>
                <p>
                    <input type="submit" value="Envoyer">
                </p>

                <span class="mdp_oublie">Vous avez oubliez votre mot de passe ?<a href="mot_de_passe_oublie.php" >Mot de passe oublié</a></span>

            </form>
            <a href="login.php?inscription=1" class="btn_inscrire">S'inscrire</a>
        </div>

        <?php

            if( isset($_GET['inscription']) && $_GET['inscription'] == 1)
            {
                ?>
                <form action="verifinscription.php" method="POST" class="inscription">
                    <p>

                        <label>
                            Nom :
                            <input type="text" name="nom" />


                        </label>

                    </p>
                    <p>
                        <label>
                            Prénom :
                            <input type="text" name="prenom" />
                        </label>
                    </p>
                    <p>
                        <label>
                            Identifiant :
                            <input type="text" name="username" />
                        </label>
                    </p>
                    <p>
                        <label>

                            Mot de passe : 
                            <input type="password" name="password" />

                        </label>
                    </p>
                    <p>
                        <label>

                            Question secrète : 
                            <input type="text" name="question_secrete" />

                        </label>
                    </p>
                    <p>
                        <label>

                            Réponse question secrète : 
                            <input type="text" name="reponse" />
                        
                        </label>
                    </p>
                    <p>

                        <input type="submit" name="S\'inscrire" />
 
                    </p>




                </form>
            <?php

            }
        
        ?>
    </body>
</html>
