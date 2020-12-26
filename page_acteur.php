<?php
session_start();
if (!empty($_SESSION)) {
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
                <img src="images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf_pacteur" />

                <div class="nom_prenom_pacteur">

                    <a href="profil.php?modif=0"><img src="images/user.png" alt="profil_icone" class="profil_ic" /></a>

                    <?php

                    echo  $_SESSION['prenom'] . ' - ' . $_SESSION['nom'];

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
                $donnee_acteur = $bdd->prepare('SELECT acteur.*
                            FROM acteur
                            WHERE id_acteur = ?');
                $donnee_acteur->execute(array($_GET['id']));
                $acteur = $donnee_acteur->fetch();

                // Compteur de like/ dislike
                $vote_like = $bdd->prepare('SELECT likes FROM vote WHERE id_acteur = ? AND likes != 0');
                $vote_like->execute(array($_GET['id']));
                $likesCount = $vote_like->rowCount();

                $vote_dislike = $bdd->prepare('SELECT dislikes FROM vote WHERE id_acteur = ? AND dislikes != 0');
                $vote_dislike->execute(array($_GET['id']));
                $dislikesCount = $vote_dislike->rowCount();

                // Compteur de commentaire
                $commentaire = $bdd->prepare('SELECT post FROM post WHERE id_acteur = ?');
                $commentaire->execute(array($_GET['id']));
                $com_count = $commentaire->rowCount();
                ?>
                <div class="logopacteur"><img src="logoacteurs/<?php echo $acteur['logo']; ?>" alt="logo_acteur" class="logo_acteur_pacteur" /></div>
                <!-- lien de retour sur la liste des acteurs -->
                <a href="index.php" class="bouton_retour">Retour</a>
                <!-- Nom de l'acteur en h2 -->

                <h2><?php echo $acteur['acteur']; ?></h2>

                <?php
                echo '<div class="description_acteur">' .  nl2br($acteur['description']) . '</div>';
                ?>
                <?php
                $donnee_acteur->closeCursor();
                ?>
            </div>
        </section>
        <section>
            <article class="cadre_com">
                <?php echo $com_count . ' Commentaires '; ?>
                <div class="bouton_vote">
                    <?php include 'bouton_nouveau_commentaire.js'; ?>
                    <button class="new_com" onclick="javascript:montrer_spoiler('spoiler2')">
                        Nouveau commentaire
                    </button>

                    <form action="verifvote.php" method="POST" class="vote">

                        <input type="hidden" value="1" name="like" />
                        <input type="hidden" value="<?php echo "" . $_GET['id']; ?>" name="id_acteur" />
                        <button type="submit" class="btn_like"><?php echo $likesCount . ' '; ?><i class="far fa-thumbs-up"></i></button>
                    </form>

                    <form action="verifvote.php" method="POST" class="vote">
                        <input type="hidden" value="1" name="dislike" />
                        <input type="hidden" value="<?php echo "" . $_GET['id']; ?>" name="id_acteur" />
                        <button type="submit" class="btn_dislike"><?php echo $dislikesCount . ' '; ?><i class="far fa-thumbs-down"></i></button>
                    </form>

                    <div id="spoiler2">
                        <form action="verifpost.php" method="POST" class="new_com">
                            <textarea name="nouveau_commentaire">Ecrivez votre commentaire</textarea>
                            <input type="hidden" name="id_acteur" value="<?php echo "" . $_GET['id']; ?>" />
                            <input type="submit" value="Envoyer" />
                        </form>
                    </div>
                </div>
                <?php
                //récupération des commentaires
                $requete = $bdd->prepare('SELECT id_post,id_user,id_acteur,DATE_FORMAT(date_add, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr, post FROM post WHERE id_acteur =?');
                $requete->execute(array($_GET['id']));

                while ($commentaire = $requete->fetch()) {
                    $account = $bdd->prepare('SELECT nom, prenom FROM account WHERE id_user = ?');
                    $account->execute(array($commentaire['id_user']));
                    $profil = $account->fetch();
                ?>
                    <div class="commentaire">
                        <?php echo  $commentaire['date_creation_fr'] . ' par :' . $profil['prenom'] . '<br>'; ?>
                        <?php echo $commentaire['post'] . '<br>'; ?>
                    </div>
                <?php
                }
                $requete->closeCursor();
                ?>
            </article>
        </section>
        <footer>
            <?php
            include '_footer.php'
            ?>
        </footer>
    </body>

    </html>
<?php
} else {
    header('location:login.php');
}
?>