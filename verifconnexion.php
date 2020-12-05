<?php
    
// On test si les variables sont initialisé et non vide. 
if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) 
{
    include 'base.php';
    $requete = $bdd->prepare('SELECT id_user, password, nom, prenom FROM account WHERE username = :pseudo');
    $pseudo = strval($_POST['username']); // on oblige le pseudo a être une chaine de charactère
    $requete->execute(array(
    'pseudo' => $pseudo));

    $resultat = $requete->fetch();

    //Verification du mdp 
    
    $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

    if (!$resultat) {
        echo 'Mauvais identifiant ou mot de passe !';
    } else {
        if ($isPasswordCorrect) {
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
}
else
{
    echo 'Veuillez saisir un identifiant et mot de passe valide';
}


?>