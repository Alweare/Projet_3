<?php
session_start();

include 'base.php';

$user = $_SESSION['id'];

//Test d'initialisation des variables récupérer des boutons like/dislike et test si vide ou non. 

if(isset($_POST['id_acteur'], ($_POST['like'])) && !empty($_POST['id_acteur']) && !empty($_POST['like']))
{
    // sécuriser les variables reçu en les passant en entier.
    $id_acteur = intval($_POST['id_acteur']);
    $like = intval($_POST['like']);
    // On récupère la table tout de la table vote avec l'id user et l'id acteur en paramètre
    $test_like = $bdd->prepare('SELECT likes, dislikes, id_acteur, account.id_user
    FROM vote 
    INNER JOIN account 
    ON vote.id_user = account.id_user
    WHERE vote.id_acteur = ? AND account.id_user = ?');
    $test_like->execute(array($id_acteur, $user));
    $test = $test_like->fetch();

    if(empty($test['id_user']) && empty($test['likes']))
    {
        
        $insert = $bdd->prepare('INSERT INTO vote(id_user,id_acteur,likes) VALUES (:id_user, :id_acteur, :likes)');
        $insert = $insert->execute(array(
           'id_user' => $user,
           'id_acteur' => $id_acteur,
           'likes' => $like));
    }
    elseif(!empty($test['id_user']))
    {
        $delete = $bdd->prepare('DELETE FROM vote WHERE id_user = ? AND id_acteur = ? AND likes = 1');
        $delete = $delete->execute(array($user, $id_acteur));
    }

    if(!empty($test['id_user']) && $test['dislikes'] == 1)
    {
        $delete = $bdd->prepare('DELETE FROM vote WHERE id_user = ? AND id_acteur = ? AND dislikes = 1');
        $delete = $delete->execute(array($user, $id_acteur));

        $insert = $bdd->prepare('INSERT INTO vote(id_user,id_acteur,likes) VALUES (:id_user, :id_acteur, :likes)');
        $insert = $insert->execute(array(
           'id_user' => $user,
           'id_acteur' => $id_acteur,
           'likes' => $like));


    }


}
if(isset($_POST['id_acteur'], ($_POST['dislike'])) && !empty($_POST['id_acteur']) && !empty($_POST['dislike']))
{
    // sécuriser les variables reçu en les passant en entier.
    $id_acteur = intval($_POST['id_acteur']);
    $dislike = intval($_POST['dislike']);
    // On récupère la table tout de la table vote avec l'id user et l'id acteur en paramètre
    $test_dislike = $bdd->prepare('SELECT dislikes, likes, id_acteur, account.id_user
    FROM vote 
    INNER JOIN account 
    ON vote.id_user = account.id_user
    WHERE vote.id_acteur = ? AND account.id_user = ?');
    $test_dislike->execute(array($id_acteur, $user));
    $test = $test_dislike->fetch();

    if(empty($test['id_user']) && empty($test['dislikes']))
    {
        
        $insert = $bdd->prepare('INSERT INTO vote(id_user,id_acteur,dislikes) VALUES (:id_user, :id_acteur, :dislikes)');
        $insert = $insert->execute(array(
           'id_user' => $user,
           'id_acteur' => $id_acteur,
           'dislikes' => $dislike));
    }
    elseif(!empty($test['id_user']))
    {
        $delete = $bdd->prepare('DELETE FROM vote WHERE id_user = ? AND id_acteur = ? AND dislikes = 1');
        $delete = $delete->execute(array($user, $id_acteur));
    }
    
    if(!empty($test['id_user']) && $test['likes'] == 1)
    {
        $delete = $bdd->prepare('DELETE FROM vote WHERE id_user = ? AND id_acteur = ? AND likes = 1');
        $delete = $delete->execute(array($user, $id_acteur));

        $insert = $bdd->prepare('INSERT INTO vote(id_user,id_acteur,dislikes) VALUES (:id_user, :id_acteur, :dislikes)');
        $insert = $insert->execute(array(
           'id_user' => $user,
           'id_acteur' => $id_acteur,
           'dislikes' => $dislike));


    }

}

    if (isset($_SERVER["HTTP_REFERER"])) { 
    header("Location: " . $_SERVER["HTTP_REFERER"]); 
   } 





?>