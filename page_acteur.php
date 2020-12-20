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
                <div class="header_border_pacteur">
                    <img src="images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf_pacteur"/>
                    <div id="nom_prenom_pacteur">
                            
                        <img src="images/user.png" alt="profil_icone" class="profil_ic" />
                        
                        <?php 
                            
                            echo  $_SESSION['prenom'] . ' - '. $_SESSION['nom'];
                            
                        ?>
                        <img src="images/logout.png" alt="profil_icone" class="profil_ic" />
                    </div>

                    
                    
                </div>
                <!-- Logo GBAF miniature haut gauche + avatar nom prénom à droite. On récup avec la session en php -->



            </header>
            <!-- Section acteur -->
            <section>
                <?php




                    include 'base.php';
                    // On prépare la requête pour afficher les acteurs + les commentaires. 
                    $requete = $bdd->prepare('SELECT acteur.*
                    FROM acteur
                    WHERE id_acteur = ?');
                    $requete->execute(array($_GET['id']));
                    $acteur = $requete->fetch();

                    
                    $like = $bdd->prepare('SELECT likes FROM vote WHERE id_acteur = ? AND likes != 0');
                    $like->execute(array($_GET['id']));
                    $likesCount = $like->rowCount();

                    $dislike = $bdd->prepare('SELECT dislikes FROM vote WHERE id_acteur = ? AND dislikes != 0');
                    $dislike->execute(array($_GET['id']));
                    $dislikesCount = $dislike->rowCount();

                ?>


                

                

                <img src="logoacteurs/<?php echo $acteur['logo']; ?>" <?php echo 'alt=logo de ' . $acteur['acteur']; ?> id="logo_acteur_pacteur" />
                <!-- lien de retour sur la liste des acteurs -->
                <a href="index.php" class="bouton_retour">Retour à la liste</a>
                <!-- Nom de l'acteur en h2 -->

                <h2><?php echo $acteur['acteur']; ?></h2>

                <p>

                    <?php echo nl2br($acteur['description']); ?>
                    
                </p>

               
            <?php
                $requete->closeCursor();
            
            ?>
            </section>
            <section>

                <article class="cadre_com">
            
                    Commentaires
                
                    <div class="bouton_vote">

                        <?php echo $likesCount; ?>


                        <form action="verifvote.php" method="POST" class="vote">
                            <input type="hidden" value="1" name="like" />
                            <input type="hidden" value="<?php echo "" . $_GET['id']; ?>" name="id_acteur"/>
                            <input type="submit" value="like" class="btn_like"> 
                        </form>
                        <?php echo $dislikesCount ?>
                        <form action="verifvote.php" method="POST" class="vote" >
                            <input type="hidden" value="1" name="dislike" />
                            <input type="hidden" value="<?php echo "" . $_GET['id']; ?>" name="id_acteur"/>
                            <input type="submit" value="dislike" class="btn_dislike">
                        </form>

                    </div>

                    <?php
                    //récupération des commentaires
                    $requete = $bdd->prepare('SELECT * FROM post WHERE id_acteur =?');
                    $requete->execute(array($_GET['id']));
                    
                    while ($commentaire = $requete->fetch()) {
                        $account = $bdd->prepare('SELECT nom, prenom FROM account WHERE id_user = ?');
                        $account->execute(array($commentaire['id_user']));
                        $profil = $account->fetch();
                
                     ?>
                    
                        <div id="commentaire">
                            

                             

                            <?php echo  $commentaire['date_add'] . 'par :'. $profil['prenom'] . '</br>' ;?> 
                            <?php echo $commentaire['post'] . '</br>' ;?>
                            
                            
                        </div>
                        <?php
                        }    
                        $requete->closeCursor();
                        ?>   

                    
                        
                        <p>  
                            <form action="verifpost.php" method="POST" class="new_com">
                            
                                
                            <textarea  name="nouveau_commentaire">Ecrivez votre commentaire</textarea>
                            

                            
                            <input type="hidden" name="id_acteur" value="<?php echo "" .$_GET['id'] ; ?>" />
                            
                            <input type="submit"  value="Envoyer" />

                            </form>
                        </p>
                     </article>

            

                    
                

            
            </section>
            
        </body>
    </html>
<?php
}
?>
