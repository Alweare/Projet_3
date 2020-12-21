<?php

if (!empty($_POST['username'])) {
    include '../base.php';
    $username = htmlspecialchars($_POST['username']);
    $bdd = $bdd->prepare('SELECT id_user,question, reponse FROM account WHERE username = ?');
    $bdd->execute(array($username));
    $test = $bdd->fetch();

    if (!empty($username) && !empty($_POST['password'])) 
    {
        include '../base.php';
        $modif = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password_modif = $bdd->prepare('UPDATE account SET password = :password WHERE id_user = :id_user');
        $password_modif->execute(array(
        'password' => $modif,
        'id_user' => $test['id_user']));

        echo 'Mot de passe correctement modifié <a href="../login.php">Se connecter</a>';
    }
    else
    {
        echo 'Erreur';
    }
}
else
{
    echo 'Erreur';
}





?>