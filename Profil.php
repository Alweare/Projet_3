<?php
session_start();
if (!empty($_SESSION)) {
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/95794a4896.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css" />
        <title>Profile</title>
    </head>

    <body>
        <header>
            <div class="header_border_pacteur">
                <img src="images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf_pacteur" />
                <!-- bandeau Nom et prénom de l'utilisateur gérer avec la superglobale $SESSION -->
                <div class="nom_prenom_pacteur">
                    <a href="profil.php?modif=0"><img src="images/user.png" alt="profil_icone" class="profil_ic" /></a>

                    <?php

                    echo  $_SESSION['prenom'] . ' - ' . $_SESSION['nom'];

                    ?>
                    <a href="deconnexion.php"><img src="images/logout.png" alt="profil_icone" class="profil_ic" /></a>
                </div>
            </div>
            <a href="index.php" class="bouton_retour">Retour</a>
        </header>
        <section>
            <?php
            // récupération des informations du profiles de l'utilisateur dans la base de donnée en utilisant l'id de session comme filtre pour notre requête préparée.
            include 'base.php';
            $profil = $bdd->prepare('SELECT nom, prenom, username, password, question, reponse FROM account WHERE id_user = ?');
            $profil->execute(array($_SESSION['id']));
            $donnees = $profil->fetch();
            ?>
            <div class="info">
                <p>
                    Nom :<br> <?php echo $donnees['nom']; ?> <a href="profil.php?modif=1"><i class="fas fa-pencil-alt"></i></a>
                    <?php
                    // Utilisation d'un indice de modification "modif" qui est un paramètre passé en url par les liens stylisés sous forme de crayon avec fontawesome
                    $modif = intval($_GET['modif']);
                    // chaque information du profil est géré avec un indice de modification différent allant de 1 à 6. 
                    if (isset($modif) && !empty($modif) && $modif == 1) {
                    ?>
                        <form action="modifprofil.php" method="POST">
                            <label>
                                Nom :
                                <input type="text" name="modif" />
                            </label>
                            <!-- passage de la valeur de l'indice de modification vers la page de modification de profil avec la méthode post en mettant un input caché à l'utilisateur -->
                            <input type="hidden" value="1" name="indice" />
                            <input type="submit" name="Valider" />

                        </form>
                    <?php
                    }
                    ?>
                </p>
                <p>
                    Prenom :<br> <?php echo $donnees['prenom']; ?> <a href="profil.php?modif=2"><i class="fas fa-pencil-alt"></i></a>
                    <?php
                    $modif = intval($_GET['modif']);
                    if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 2) {
                    ?>
                        <form action="modifprofil.php" method="POST">
                            <label>
                                Prénom :
                                <input type="text" name="modif_prenom" />
                            </label>
                            <input type="hidden" value="2" name="indice" />
                            <input type="submit" name="Valider" />
                        </form>
                    <?php
                    }
                    ?>
                </p>
                <p>
                    Username : <br><?php echo $donnees['username']; ?> <a href="profil.php?modif=3"><i class="fas fa-pencil-alt"></i></a>
                    <?php
                    $modif = intval($_GET['modif']);
                    if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 3) {
                    ?>
                        <form action="modifprofil.php" method="POST">
                            <label>
                                Nom :
                                <input type="text" name="modif_username" />
                            </label>
                            <input type="submit" name="Valider" />
                            <input type="hidden" value="3" name="indice" />
                        </form>
                    <?php
                    }
                    ?>
                </p>
                <p>
                    Mot de passe : <br> ****** <a href="profil.php?modif=6"><i class="fas fa-pencil-alt"></i></a>
                    <?php
                    $modif = intval($_GET['modif']);
                    if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 6) {
                    ?>
                        <form action="modifprofil.php" method="POST">
                            <label>
                                Nouveau mot de passe :
                                <input type="password" name="modif_password" />
                            </label>
                            <input type="hidden" value="6" name="indice" />
                            <input type="submit" name="Valider" />
                        </form>
                    <?php
                    }
                    ?>
                </p>
                <p>
                    Question secrète : <br><?php echo $donnees['question']; ?> <a href="profil.php?modif=4"><i class="fas fa-pencil-alt"></i></a>
                    <?php
                    $modif = intval($_GET['modif']);
                    if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 4) {
                    ?>
                        <form action="modifprofil.php" method="POST">
                            <label>
                                Question :
                                <input type="text" name="modif_question" />
                            </label>
                            <input type="hidden" value="4" name="indice" />
                            <input type="submit" name="Valider" />
                        </form>
                    <?php
                    }
                    ?>
                </p>
                <p>
                    Réponse secrète : <br><?php echo $donnees['reponse']; ?> <a href="profil.php?modif=5"><i class="fas fa-pencil-alt"></i></a>
                    <?php
                    $modif = intval($_GET['modif']);
                    if (isset($modif) && !empty($modif) && is_int($modif) && $modif == 5) {
                    ?>
                        <form action="modifprofil.php" method="POST">
                            <label>
                                Nom :
                                <input type="text" name="modif_reponse" />
                            </label>
                            <input type="hidden" value="5" name="indice" />
                            <input type="submit" name="Valider" />
                        </form>
                    <?php
                    }
                    ?>
                </p>
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
} else {
    header('location:login.php');
}
?>