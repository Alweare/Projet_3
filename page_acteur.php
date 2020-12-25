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
            <script src="https://kit.fontawesome.com/95794a4896.js" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="style.css" />
            <title>Nos acteurs</title>
        </head>
        <body>

            <header>
                <div class="header_border_pacteur">
                    <img src="images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf_pacteur"/>

                    <div class="nom_prenom_pacteur">

                        <a href="profil.php?modif=0"><img src="images/user.png" alt="profil_icone" class="profil_ic" /></a>
                        
                                <?php 
                                    
                                    echo  $_SESSION['prenom'] . ' - '. $_SESSION['nom'];
                                    
                                ?>
                        <a href="deconnexion.php"><img src="images/logout.png" alt="profil_icone" class="profil_ic" /></a>
                    </div>

                    
                    
                </div>
                <!-- Logo GBAF miniature haut gauche + avatar nom prénom à droite. On récup avec la session en php -->



            </header>
            <!-- Section acteur -->
            <section>
            <div class="corps_page_acteur">
                    <?php




                        include 'base.php';
                        // On prépare la requête pour afficher les acteurs + les commentaires. 
                        $requete = $bdd->prepare('SELECT acteur.*
                        FROM acteur
                        WHERE id_acteur = ?');
                        $requete->execute(array($_GET['id']));
                        $acteur = $requete->fetch();

                        // Compteur de like/ dislike
                        $like = $bdd->prepare('SELECT likes FROM vote WHERE id_acteur = ? AND likes != 0');
                        $like->execute(array($_GET['id']));
                        $likesCount = $like->rowCount();

                        $dislike = $bdd->prepare('SELECT dislikes FROM vote WHERE id_acteur = ? AND dislikes != 0');
                        $dislike->execute(array($_GET['id']));
                        $dislikesCount = $dislike->rowCount();

                        // Compteur de commentaire
                        $com_count = $bdd->prepare('SELECT post FROM post WHERE id_acteur = ?');
                        $com_count->execute(array($_GET['id']));
                        $com_count = $com_count->rowCount();
                        

                    ?>


                    

                    

                    <div class="logopacteur"><img src="logoacteurs/<?php echo $acteur['logo']; ?>" alt="logo_acteur"  class="logo_acteur_pacteur"/></div>
                    <!-- lien de retour sur la liste des acteurs -->
                    <a href="index.php" class="bouton_retour">Retour à la liste</a>
                    <!-- Nom de l'acteur en h2 -->

                    <h2><?php echo $acteur['acteur']; ?></h2>
                    
                        <p>

                            <?php echo'<div class="description_acteur">'.  nl2br($acteur['description']) . '</div>';?>
                            
                        </p>
                    

                
                <?php
                    $requete->closeCursor();
                
                ?>
                </section>
                <section>

                    <article class="cadre_com">
                
                        
                        <?php echo $com_count . ' Commentaires '; ?>
                        <div class="bouton_vote">
                            

                           

                            <button class="new_com" onclick="javascript:montrer_spoiler('spoiler2')">
                            Nouveau commentaire
                            </button>

                            <script type="text/javascript">
                            function montrer_spoiler(value){var actual=document.getElementById(value).style.display;
                            if (actual=='block'){document.getElementById(value).style.display='none';}
                            else{document.getElementById(value).style.display='block';
                            }}
                            </script>
                            
                                <form action="verifvote.php" method="POST" class="vote">
                                
                                    <input type="hidden" value="1" name="like" />
                                    <input type="hidden" value="<?php echo "" . $_GET['id']; ?>" name="id_acteur"/>
                                    <button type="submit" class="btn_like"><?php echo $likesCount . ' '; ?><i class="far fa-thumbs-up"></i></button>
                                </form>
                            
                            
                                                    
                            <form action="verifvote.php" method="POST" class="vote" >
                                <input type="hidden" value="1" name="dislike" />
                                <input type="hidden" value="<?php echo "" . $_GET['id']; ?>" name="id_acteur"/>
                                <button type="submit" class="btn_dislike"><?php echo $dislikesCount .' ' ;?><i class="far fa-thumbs-down"></i></button>
                            </form>
                            <div id="spoiler2">
                                 
                                <form action="verifpost.php" method="POST" class="new_com">
                                
                                    
                                <textarea  name="nouveau_commentaire">Ecrivez votre commentaire</textarea>
                                

                                
                                <input type="hidden" name="id_acteur" value="<?php echo "" .$_GET['id'] ; ?>" />
                                
                                <input type="submit"  value="Envoyer" />

                                </form>
                            
                            </div>
                            

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
                        
                            <div class="commentaire">
                                

                                

                                <?php echo  $commentaire['date_add'] . 'par :'. $profil['prenom'] . '<br>' ;?> 
                                <?php echo $commentaire['post'] . '<br>' ;?>
                                
                                
                            </div>
                            <?php
                            }    
                            $requete->closeCursor();
                            ?>   

                
                        </article>

                

                        
                    

                </div>  
                </section>
            
            
            <footer>
                <?php
                    include '_footer.php'
                ?>
            </footer>
        </body>
    </html>
<?php
}
?>
