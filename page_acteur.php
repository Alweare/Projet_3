<?php
session_start();
if (!empty($_SESSION)) 
{
    ?>
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
                <p>

                    <?php 
                        echo $_SESSION['nom'] . ' - ';
                        echo $_SESSION['prenom'];
                    ?>
                
                </p>


            </header>
            <!-- Section 1 acteur -->
            <section>
                <?php
                    include 'base.php';
            // On prépare la requête pour afficher les acteurs + les commentaires. Jointure table acteur entière et id, post et date de la table post.
            $requete = $bdd->prepare('SELECT acteur.*
            FROM acteur
            WHERE id_acteur = ?');
            $requete->execute(array($_GET['id']));

            $acteur = $requete->fetch();
            ?>
                <!-- Nom de l'acteur en h2 -->

                <h2><?php echo $acteur['acteur']; ?></h2>

                <!-- Mettre un lien ? Probablement de retour sur la liste des acteurs -->

                <a href="index.php">Retour à la liste</a>

                <img src="logoacteurs/<?php echo $acteur['logo']; ?>" <?php echo 'alt=logo de ' . $acteur['acteur']; ?> />

                <p>

                    <?php echo nl2br($acteur['description']); ?>
                    
                </p>
               
            <?php
                $requete->closeCursor();
            
            ?>
            </section>
            <section>
                
                <?php
                //récupération des commentaires
                $requete = $bdd->prepare('SELECT * FROM post WHERE id_acteur =? ');
                $requete->execute(array($_GET['id']));
                while ($commentaire = $requete->fetch()) {
                    ?>

                <p>
                    Commentaires :</br> 
                </p>
                <p>
                    <?php if (!empty($commentaire)) {
                        $account = $bdd->prepare('SELECT nom, prenom FROM account WHERE id_user = ?');
                        $account->execute(array($commentaire['id_user']));
                        $profil = $account->fetch();
                        echo $commentaire['post'] . '</br>' . $commentaire['date_add'] . 'par :' . $profil['nom']. ' - ' . $profil['prenom'];
                    } else {
                        echo 'Aucun commentaire, soyez le premier !';
                    } ?>
                </p>

                <?php
                }
                $requete->closeCursor();
                ?>


            

        


            
            </section>
            
        </body>
    </html>
<?php
}
?>
