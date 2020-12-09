<?php
session_start();
if (!empty($_SESSION)) 
{
    ?>
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css" />
            <title>Nos acteurs</title>
        </head>
        <body>

            <header>

                <div>
                    <img src="images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf"/>
                </div>
                <!-- Logo GBAF miniature haut gauche + avatar nom prénom à droite. On récup avec la session en php -->
                <div id="nom_prenom">
                    
                    <?php 
                        echo $_SESSION['prenom'] . ' - '. $_SESSION['nom'];
                         
                    ?>
                </div>


            </header>
            <!-- Section acteur -->
            <section>
                <?php


                    // Test de l'id reçu en paramètre d'url et mise en variable entier 
                    // if(!empty($_GET['id']))
                    // {
                    //     $idacteur = $_GET['id'];
                    // }
                    // else
                    // {
                    //     echo 'l\'acteur que vous chercher n\'existe pas';
                    // }

                            include 'base.php';
                    // On prépare la requête pour afficher les acteurs + les commentaires. 
                    $requete = $bdd->prepare('SELECT acteur.*
                    FROM acteur
                    WHERE id_acteur = ?');
                    $requete->execute(array($_GET['id']));

                    $acteur = $requete->fetch();
                ?>
                <!-- Nom de l'acteur en h2 -->

                <h2><?php echo $acteur['acteur']; ?></h2>

                <!-- lien de retour sur la liste des acteurs -->

                <a href="index.php">Retour à la liste</a>

                <img src="logoacteurs/<?php echo $acteur['logo']; ?>" <?php echo 'alt=logo de ' . $acteur['acteur']; ?> id="logo_acteur" />

                <p>

                    <?php echo nl2br($acteur['description']); ?>
                    
                </p>
               
            <?php
                $requete->closeCursor();
            
            ?>
            </section>
            <section>

                <p>
                    <h3>Commentaires :</br></h3>
                </p>

                <?php
                //récupération des commentaires
                $requete = $bdd->prepare('SELECT * FROM post WHERE id_acteur =?');
                $requete->execute(array($_GET['id']));
                
                while ($commentaire = $requete->fetch()) 
                {
                    $account = $bdd->prepare('SELECT nom, prenom FROM account WHERE id_user = ?');
                    $account->execute(array($commentaire['id_user']));
                    $profil = $account->fetch();
                    echo '</br>' . $commentaire['post'] . '</br>' . $commentaire['date_add'] . 'par :' . $profil['nom']. ' - ' . $profil['prenom'];
                 }
                 $requete->closeCursor();
                 ?>   

               
                
                <p>  
                    <form action="verifpost.php" method="POST">
                    <label>
                        <input type="text" name="nouveau_commentaire" />
                    </label>
                        
                    <input type="hidden" name="id_acteur" value="<?php echo "" .$_GET['id'] ; ?>" />
                     
                    <input type="submit"  value="Envoyer" />

                    </form>
                </p>

            

                    
                

            
            </section>
            
        </body>
    </html>
<?php
}
?>
