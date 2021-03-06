<?php
session_start();

include 'base.php';

if (isset($_POST['modif']) && !empty($_POST['modif']) && !empty($_POST['indice'])) {
    $modif = htmlspecialchars($_POST['modif']);
    $indice = intval($_POST['indice']);
} else {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
// utilisation d'un switch case pour faire les modifications; On récupère en méthode POST l'indice de modification renvoyé par le champs caché du formulaire profil. 
switch ($indice) {

    case 1:
        $nom_modif = $bdd->prepare('UPDATE account SET nom = :nom WHERE id_user = :id_user');
        $nom_modif->execute(array(
            'nom' => $modif,
            'id_user' => $_SESSION['id']
        ));
        break;

    case 2:
        $modif = htmlspecialchars($_POST['modif_prenom']);
        $prenom_modif = $bdd->prepare('UPDATE account SET prenom = :prenom WHERE id_user = :id_user');
        $prenom_modif->execute(array(
            'prenom' => $modif,
            'id_user' => $_SESSION['id']
        ));
        break;

    case 3:
        $modif = htmlspecialchars($_POST['modif_username']);
        $username_modif = $bdd->prepare('UPDATE account SET username = :username WHERE id_user = :id_user');
        $username_modif->execute(array(
            'username' => $modif,
            'id_user' => $_SESSION['id']
        ));
        break;

    case 4:
        $modif = htmlspecialchars($_POST['modif_question']);
        $question_modif = $bdd->prepare('UPDATE account SET question = :question WHERE id_user = :id_user');
        $question_modif->execute(array(
            'question' => $modif,
            'id_user' => $_SESSION['id']
        ));
        break;

    case 5:
        $modif = htmlspecialchars($_POST['modif_reponse']);
        $reponse_modif = $bdd->prepare('UPDATE account SET reponse = :reponse WHERE id_user = :id_user');
        $reponse_modif->execute(array(
            'reponse' => $modif,
            'id_user' => $_SESSION['id']
        ));
        break;

    case 6:
        $modif = password_hash($_POST['modif_password'], PASSWORD_DEFAULT);
        $password_modif = $bdd->prepare('UPDATE account SET password = :password WHERE id_user = :id_user');
        $password_modif->execute(array(
            'password' => $modif,
            'id_user' => $_SESSION['id']
        ));

        break;
}



if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>