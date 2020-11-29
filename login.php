<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
        <title>Document</title>
    </head>
    <body>
            <form action="" method="POST"> 

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
                <p>
                    <label>
                        Si vous n'avez pas de compte.

                        <input type="submit" value="Inscription" />
                    
                    </label>
                
                </p>
            </form>

        <?php

        if(isset($_POST['Inscription']) && $_POST == true)
        {
            ?>
            <form action="" method="POST">
                <p>

                    <label>
                        Nom :
                        <input type="text" value="nom" />


                    </label>

                </p>
                <p>
                    <label>
                        Prénom :
                        <input type="text" value="prenom" />
                    </label>
                </p>
                <p>
                    <label>
                        Identifiant :
                        <input type="text" value="username" />
                    </label>
                </p>
                <p>
                    <label>

                        Mot de passe : 
                        <input type="password" value="password" />

                    </label>
                </p>
                <p>
                    <label>

                        Question secrète : 
                        <!-- mettre une liste déroulante pour les choix de question -->

                    </label>
                </p>
                <p>
                    <label>

                        Réponse question secrète : 
                        <input type="text" value="reponse" />
                    
                    </label>
                </p>




            </form>
        <?php

        }
        


        ?>
    </body>
</html>
