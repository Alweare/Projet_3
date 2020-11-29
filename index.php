<?php
    //Ne pas oublier les super globale session start et cookie
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="utf-8" />
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

            <h2>acteurs et partenaire</h2> <!-- Titre de section -->

            <!-- appel de base de donnée et boucle php pour afficher les acteurs -->
            <?php
                $bdd = new PDO('mysql:host=localhost;dbname=gbafapp', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $requete = $bdd->query('SELECT * FROM acteur LIMIT 0,6');
                
                while ($acteur = $requete->fetch())
                {
                ?>
                    <article >
                        <div id="acteur">


                            <img src="logoacteurs/<?php echo $acteur['logo']; ?>" <?php echo 'alt=logo de ' . $acteur['acteur'];?> />  <!-- changer le alt logo par logo_(nom de l'acteur )-->
                            <h3>
                                <?php echo $acteur['acteur']; ?>   <!-- sous titre a mettre -->
                            </h3>
                            <p>
                                <?php echo nl2br($acteur['description']); ?>
                            </p>
                        
                            
                            <a href="acteur.php?id=<?php echo $acteur['id_acteur']; ?>" id="bouton_lire_la_suite">Lire la suite</a>
                        </div>
                </article>
                <?php     
                }
                 $requete->closeCursor();

                 ?>
                
            
            


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