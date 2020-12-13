<?php
    // Récupération de la session
    session_start();

    //récupération de la base de donnée du projet
    include 'base.php';

    if(isset($_POST['id_acteur']) && !empty($_POST['id_acteur']))
    {
        $id_acteur = intval($_POST['id_acteur']);
    }



    // Test si le commentaire et l'id de l'acteur sont initialisé et que le commentaire n'est pas vide. 
    if (isset($_POST['nouveau_commentaire'],$id_acteur) && !empty($_POST['nouveau_commentaire']))
    {
        // On récupère les informations de la page acteur et on les sécurises. 

        $nouveau_post = htmlspecialchars($_POST['nouveau_commentaire']);
        $iduser = intval($_SESSION['id']);

        // on récupère dans la table post le champ id_user et on filtre par id_acteur et id_user. 
        $check_post = $bdd->prepare('SELECT id_user FROM post WHERE id_acteur = ? AND id_user = ?');
        $check_post->execute(array($id_acteur, $iduser));
        $check_post = $check_post->fetch();

        // S'il ne trouve pas l'id de l'utilisateur en cours dans la table post il permet d'insérer le commentaire en base.
        if(empty($check_post['id_user']))
        {
            // Insertion nouveau commentaire dans la base.
            $nouveau_commentaire = $bdd->prepare('INSERT INTO post(id_user, post, id_acteur) VALUES(:id_user,:post, :id_acteur )');
            $nouveau_commentaire->execute(array(
                'id_user' => $_SESSION['id'],
                'post' => $nouveau_post,
                'id_acteur' => $id_acteur));

            

        }
        
        else 
        {
            echo 'Vous avez déjà mis un commentaire ' .$_SESSION['prenom'];
        }
    }
    else
    {
        echo 'Erreur';
    }
   
    if (isset($_SERVER["HTTP_REFERER"])) { 
        header("Location: " . $_SERVER["HTTP_REFERER"]); 
       } 
    
?>