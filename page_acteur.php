<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nos acteurs</title>
    </head>
    <body>

        <header>
            <!-- Logo GBAF miniature haut gauche + avatar nom prénom à droite. On récup avec la session en php -->
        </header>
        <!-- Section 1 acteur -->
        <section>
            <?php
                 include 'base.php';
                 // On prépare la requête pour afficher les acteurs
                 $requete = $bdd->prepare('SELECT * FROM acteur WHERE id_acteur=?');
                 $requete->execute(array($_GET['id']));
                $acteur = $requete->fetch();

            ?>
            <!-- Nom de l'acteur en h2 -->

            <h2><?php echo $acteur['acteur']; ?></h2>

            <!-- Mettre un lien ? Probablement de retour sur la liste des acteurs -->

            <a href="index.php">Retour à la liste</a>

            <img src="logoacteurs/<?php echo $acteur['logo']; ?>" <?php echo 'alt=logo de ' . $acteur['acteur'];?> />

            <p>

                <?php echo nl2br($acteur['description']); ?>
                
            </p>


        </section>
        <section>
            <?php

                $verifcommentaire = $bdd->query('SELECT id_user.account,id_post.post, date_add.post,post.post,id_acteur.acteur  
                FROM account AS acc,post AS p, acteur AS act 
                INNER JOIN acc.id_user = p.id_user 
                GROUP BY p.date_add');

                $verifcommentaire->execute(array($_SESSION['id']));
                $commentaire = $verifcommentaire->fetch();

                if (empty($commentaire['post'])) 
                {
                    ?>
                <form action="page_acteur.php" method="POST">

                <p>
                    <label>
                        écrivez un commentaire :
                        <input type="text" name="commentaire" />
                    </label>
                
                </p>
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
                
                </form>
            <?php
                
                    
                }
                else
                {
                    ?>
                    <p>
                        <?php echo $commentaire['post']; ?>
                    </p>
           <?php     
            }
            $commentaire->closeCursor();


            ?>
        
        </section>
        
    </body>
</html>