
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
        <title>Document</title>
    </head>
    <body> 

        <form action="verifconnexion.php" method="POST"> 

            <p>
                <label>
                    Nom :

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

        </form>
        <a href="login.php?inscription=1">S'inscrire</a>


        <?php

            if( isset($_GET['inscription']) && $_GET['inscription'] == 1)
            {
                ?>
                <form action="verifinscription.php" method="POST">
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
