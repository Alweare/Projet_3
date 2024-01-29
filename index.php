<?php
session_start();
if (!empty($_SESSION)) {
?>

    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="style.css" />
        <title>GBAF</title>
    </head>

    <body>
        <!-- En-tête de la page -->
        <header>
            <div class="header_border">
                <img src="images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf" />

                <div id="nom_prenom">
                    <a href="profil.php?modif=0"><img src="images/user.png" alt="profil_icone" class="profil_ic" /></a>

                    <?php

                    echo  $_SESSION['prenom'] . ' - ' . $_SESSION['nom'];

                    ?>
                    <a href="deconnexion.php"><img src="images/logout.png" alt="profil_icone" class="profil_ic" /></a>
                </div>
            </div>
        </header>
        <!-- section présentation -->
        <section>

            <h1>Groupement Banque-Assurance Français</h1> <!-- à modifier avec le vrai texte -->
            <div id="presentation">
                <p>
                    Le GBAF est le représentant de la profession bancaire et des assureurs sur tous
                    les axes de la réglementation financière française.
                </p>
            </div>
            <div class="banniere">
                <img src="images/bannière.jpg" alt="Bannière gbaf" />
            </div>
        </section>
        <section>
            <div class="acteur_partenaire">
                <h2>acteurs et partenaire</h2>
            </div> <!-- Titre de section -->
            <div class="liste_acteur">
                <!-- appel de base de donnée et boucle php pour afficher les acteurs -->
                <?php
                include 'base.php';
                $requete = $bdd->query('SELECT * FROM acteur');
                while ($acteur = $requete->fetch()) {
                ?>
                    <article>
                        <div class="acteur">


                            <img src="LogoActeurs/<?php echo $acteur['logo']; ?>" alt=logo_acteur class="logo_acteur" /> <!-- changer le alt logo par logo_(nom de l'acteur )-->

                            <div class="description">
                                <h3>
                                    <?php echo $acteur['acteur']; ?>
                                    <!-- sous titre a mettre -->
                                </h3>
                                <?php if (strlen($acteur['description']) >= 200) {
                                    echo nl2br(substr($acteur['description'], 0, 190)) . '...';
                                } else {
                                    echo nl2br($acteur['description']);
                                }
                                ?>
                                <a href="page_acteur.php?id=<?php echo $acteur['id_acteur']; ?>" class="bouton_lire_la_suite">Lire la suite</a>
                            </div>
                        </div>
                    </article>
                <?php
                }
                $requete->closeCursor(); ?>
            </div>
        </section>
        <footer>
            <?php
            include '_footer.php';
            ?>
        </footer>
    </body>

    </html>
<?php
}
if (empty($_SESSION)) {
    include 'login.php';
}
?>