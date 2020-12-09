<?php
    // Récupération de la session
    session_start();

    //récupération de la base de donnée du projet
    include 'base.php';

    // if(!empty($_POST['id_acteur']) && is_int($_POST['id_acteur']))
    // {
        $id_acteur = intval($_POST['id_acteur']);
    // }
        //préparation du test pour savoir si l'id de la session à déjà un commentaire sur l'acteur
        $requete = $bdd->prepare('SELECT post.id_user AS puser, post.post, post.id_acteur AS idact, account.id_user AS accuser
        FROM post
        INNER JOIN account
        WHERE id_acteur = :id_acteur');
        $requete->execute(array(
            'id_acteur' => $_POST['id_acteur'] ));
        $test_post= $requete->fetch();
   
    // Test si un post existe déjà pour l'acteur avec cet id session
    if (!empty($_POST['nouveau_commentaire']) && !empty($id_acteur) && $test_post['puser'] !== $_SESSION['id'])
    {
        $nouveau_post = htmlspecialchars($_POST['nouveau_commentaire']);



        $req = $bdd->prepare('INSERT INTO post(id_user, post, id_acteur) VALUES(:id_user,:post, :id_acteur )');
        $req->execute(array(
            'id_user' => $_SESSION['id'],
            'post' => $nouveau_post,
            'id_acteur' => $id_acteur));

        


    }
    else
    {
        echo 'pas bon';
    }
    if (isset($_SERVER["HTTP_REFERER"])) { 
        header("Location: " . $_SERVER["HTTP_REFERER"]); 
       } 
    
?>