<?php
session_start();
// Inclusion de la base de donnée
include 'base.php';
$id_utilisateur = $_SESSION['id'];

//Test d'initialisation des variables récupérer des boutons like/dislike et test si vide ou non. 
if (isset($_POST['id_acteur'], ($_POST['like'])) && !empty($_POST['id_acteur']) && !empty($_POST['like'])) {
    // sécuriser les variables reçu en les passant en entier.
    $id_acteur = intval($_POST['id_acteur']);
    $like = intval($_POST['like']);
    // On récupère la table tout de la table vote avec l'id user et l'id acteur en paramètre
    $recuperation_vote_par_account = $bdd->prepare('SELECT likes, dislikes, id_acteur, account.id_user
    FROM vote 
    INNER JOIN account 
    ON vote.id_user = account.id_user
    WHERE vote.id_acteur = ? AND account.id_user = ?');
    $recuperation_vote_par_account->execute(array($id_acteur, $id_utilisateur));
    $information_vote = $recuperation_vote_par_account->fetch();
    //S'il n'y a pas d'id user lié à un champs like non vide on insère un like
    if (empty($information_vote['id_user']) && empty($information_vote['likes'])) {

        $insert_like = $bdd->prepare('INSERT INTO vote(id_user,id_acteur,likes) VALUES (:id_user, :id_acteur, :likes)');
        $insert_like = $insert_like->execute(array(
            'id_user' => $id_utilisateur,
            'id_acteur' => $id_acteur,
            'likes' => $like
        ));
    // Sinon si les informations de la table vote contient 1 pour l'id de l'utilisateur alors on supprime le like. ça permet de ne pas pourvoir mettre plus de 1 like par personne
    } elseif (!empty($information_vote['id_user'])) {
        $delete_like = $bdd->prepare('DELETE FROM vote WHERE id_user = ? AND id_acteur = ? AND likes = 1');
        $delete_like = $delete_like->execute(array($id_utilisateur, $id_acteur));
    }
    // Condition qui permet de ne pas avoir un like et un dislike par personne. Si la personne a déjà mis un dislike ça le supprimera et ajoutera un like.
    if (!empty($information_vote['id_user']) && $information_vote['dislikes'] == 1) {
        $delete_like = $bdd->prepare('DELETE FROM vote WHERE id_user = ? AND id_acteur = ? AND dislikes = 1');
        $delete_like = $delete_like->execute(array($id_utilisateur, $id_acteur));

        $insert_like = $bdd->prepare('INSERT INTO vote(id_user,id_acteur,likes) VALUES (:id_user, :id_acteur, :likes)');
        $insert_like = $insert_like->execute(array(
            'id_user' => $id_utilisateur,
            'id_acteur' => $id_acteur,
            'likes' => $like
        ));
    }  
}

if (isset($_POST['id_acteur'], ($_POST['dislike'])) && !empty($_POST['id_acteur']) && !empty($_POST['dislike'])) {
    // sécuriser les variables reçu en les passant en entier.
    $id_acteur = intval($_POST['id_acteur']);
    $dislike = intval($_POST['dislike']);
    // On récupère la table tout de la table vote avec l'id user et l'id acteur en paramètre
    $information_vote_par_account = $bdd->prepare('SELECT dislikes, likes, id_acteur, account.id_user
    FROM vote 
    INNER JOIN account 
    ON vote.id_user = account.id_user
    WHERE vote.id_acteur = ? AND account.id_user = ?');
    $information_vote_par_account->execute(array($id_acteur, $id_utilisateur));
    $information_vote = $information_vote_par_account->fetch();

    if (empty($information_vote['id_user']) && empty($information_vote['dislikes'])) {

        $insert = $bdd->prepare('INSERT INTO vote(id_user,id_acteur,dislikes) VALUES (:id_user, :id_acteur, :dislikes)');
        $insert = $insert->execute(array(
            'id_user' => $id_utilisateur,
            'id_acteur' => $id_acteur,
            'dislikes' => $dislike
        ));
    } elseif (!empty($information_vote['id_user'])) {
        $delete = $bdd->prepare('DELETE FROM vote WHERE id_user = ? AND id_acteur = ? AND dislikes = 1');
        $delete = $delete->execute(array($id_utilisateur, $id_acteur));
    }

    if (!empty($information_vote['id_user']) && $information_vote['likes'] == 1) {
        $delete = $bdd->prepare('DELETE FROM vote WHERE id_user = ? AND id_acteur = ? AND likes = 1');
        $delete = $delete->execute(array($id_utilisateur, $id_acteur));

        $insert = $bdd->prepare('INSERT INTO vote(id_user,id_acteur,dislikes) VALUES (:id_user, :id_acteur, :dislikes)');
        $insert = $insert->execute(array(
            'id_user' => $id_utilisateur,
            'id_acteur' => $id_acteur,
            'dislikes' => $dislike
        ));
    }
}

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>