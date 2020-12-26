<?php
// On test si les variables sont initialisé et non vide. 
if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    include 'base.php';
    $information_utilisateur = $bdd->prepare('SELECT id_user, password, nom, prenom FROM account WHERE username = :pseudo');
    $pseudo = strval($_POST['username']); // on oblige le pseudo a être une chaine de charactère
    $information_utilisateur->execute(array(
        'pseudo' => $pseudo
    ));
    //On recherche dans informations utilisateurs ligne par ligne
    $resultat = $information_utilisateur->fetch();
    //Verification du mdp  en utilisant la fonction password_verify qui test le mot de passe reçu de l'utilisateur et celui présent en base. On passe la fonction dans une variable 
    $mot_de_passe_correct = password_verify($_POST['password'], $resultat['password']);
    //S'il n'y a pas de résultat pour les informations utilisateurs c'est que le compte n'existe pas.
    if (!$resultat) {
        echo 'Mauvais identifiant ou mot de passe !';
    } else {
        // si la fonction passorw verify renvoi vrai alors on passe les information en variable de session. 
        if ($mot_de_passe_correct) {
            session_start();
            $_SESSION['id'] = $resultat['id_user'];
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['nom'] = $resultat['nom'];
            $_SESSION['prenom'] = $resultat['prenom'];
            echo 'Vous êtes connecté !';
            header('location:index.php');
        } else {
            echo 'Mauvais identifiant ou mot de passe ! ';
        }
    }
} else {
    echo 'Veuillez saisir un identifiant et mot de passe valide';
}
?>