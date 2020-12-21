<?php
  session_start();
  if (!empty($_SESSION)) 
    {
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
                    <img src="images/logo_gbaf.png" alt="Logo GBAF" class="logo_gbaf"/>
                    <div id="nom_prenom">
                            
                            <?php 
                                echo $_SESSION['prenom'] . ' - '. $_SESSION['nom'];
                                
                            ?>
                    </div>

                    
                    
                </div>
                    
                </header>
                <!-- section présentation -->
                <section id="presentation">  
                    
                    <h1>Banque humaine</h1> <!-- à modifier avec le vrai texte -->

                    <p>
                        <img src="" alt="Bannière gbaf" class="banniere" />
                    </p>


                </section>
                <section >
                    <span class="acteur_partenaire"><h2>acteurs et partenaire</h2></span> <!-- Titre de section -->
                    <div class="liste_acteur">
                    

                    <!-- appel de base de donnée et boucle php pour afficher les acteurs -->
                    <?php
                        include 'base.php';
                    // $requete = $bdd->query('SELECT * FROM acteur LIMIT 0,6'); limite de 6 acteurs comme sur le wireframe
                    $requete = $bdd->query('SELECT * FROM acteur');
                                
                                
                    while ($acteur = $requete->fetch()) {
                        ?>
                                    <article>
                                        <div id="acteur">
                                    
                                            
                                            <img src="logoacteurs/<?php echo $acteur['logo']; ?>" <?php echo 'alt=logo de ' . $acteur['acteur']; ?> id="logo_acteur" />  <!-- changer le alt logo par logo_(nom de l'acteur )-->
    
                                            <div class="description"> 
                                                <h3>
                                                    <?php echo $acteur['acteur']; ?>   <!-- sous titre a mettre -->
                                                </h3>   
                                                <?php if(strlen($acteur['description']) >= 200)
                                                {
                                                    echo nl2br(substr($acteur['description'],0,190)) . '...';
                                                }
                                                else
                                                {
                                                    echo nl2br($acteur['description']);
                                                }
                                                      ?>
                                                <button id="bouton_lire_la_suite"><a href="page_acteur.php?id=<?php echo $acteur['id_acteur']; ?>" >Lire la suite</a></button>
                                            </div>
                                        
                                            
                                            
                                        </div>
                                    </article>
                                <?php
                    }
                    $requete->closeCursor(); ?>
                    </div> 
                    
                    


                </section>


            </body>

            <footer>
                
                <ul>
                    <li>
                        <a href="#">Mentions légales</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
                    
                    
            </footer>
    </html>
<?php
  }
  ?>