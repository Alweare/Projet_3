<?php
    //Ne pas oublier les super globale session start et cookie
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="style.css" />
        <title>GBAF</title>
    </head>


    

    <body>
        <!-- En-tête de la page -->
        <header>   
            <p>
                <img src="images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf"/>
            </p> 

            <?php
                //Récupérer le nom et prénom de la personne (et son image de profil ? )
            ?>

        </header>
        <!-- section présentation -->
        <section id="presentation">  
            
            <h1>Banque humaine</h1> <!-- à modifier avec le vrai texte -->

            <p>
                <img src="" alt="Bannière gbaf" class="banniere" />
            </p>


        </section>
        <section>

            <h2>acteurs et partenaire</h2> <!-- à modifier avec le vrai texte -->

            <article>
                <img src="logoacteurs/CDE.png" alt="logo_CDE" class="Logo_CDE" />     <!-- changer le alt logo par logo_(nom de l'acteur )-->
                <h3>
                    <!-- sous titre a mettre -->
                </h3>
                <p>
                    La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.<br />
                    Son président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.<br />
                </p>
            
                
                <a href="acteur.php?id=<?php echo "ID"; ?>" id="bouton_lire_la_suite">Lire la suite</a>
            </article>

            <article>
                <img src="logoacteurs/Dsa_france.png" alt="logo_Dsa_France" class="Logo_Dsa" />
                <h3>
                    <!-- sous titre a mettre -->
                </h3>
                <p>
                    
                    Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.<br />
                    Nous accompagnons les entreprises dans les étapes clés de leur évolution.<br />
                    Notre philosophie : s’adapter à chaque entreprise.<br />
                    Nous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises<br />

                </p>
            
                <a href="acteur.php?id=<?php echo "ID"; ?>" id="bouton_lire_la_suite">Lire la suite</a>

            </article>

            <article>
                <img src="logoacteurs/formation_co.png" alt="logo_formation_co" class="Logo_formation" />
                <h3>
                    <!-- sous titre a mettre -->
                </h3>
                <p>
                    Formation&co est une association française présente sur tout le territoire.<br />
                    Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.<br />

                </p>

                <a href="acteur.php?id=<?php echo "ID"; ?>" id="bouton_lire_la_suite">Lire la suite</a>

            </article>
        </section>


    </body>

    <footer>
        <ul>
            <li>
                <a href="">Mentions légales</a>
            </li>
            <li>
                <a href="">Contact</a>
            </li>
        </ul>
            
            
    </footer>
</html>