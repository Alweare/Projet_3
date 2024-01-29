<?php
session_start();

include 'base.php';

if (empty($_SESSION)) {

    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['question_secrete']) && !empty($_POST['reponse'])) {
        $information_account = $bdd->query('SELECT * FROM account');
        $information = $information_account->fetch();
        // on sécurise les variables en utilisant htmlspecialchart on annule la possibilité de mettre du code html dans les input du formulaire. Les balise sont échapées 
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $username = htmlspecialchars($_POST['username']);
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $question = htmlspecialchars($_POST['question_secrete']);
        $reponse = htmlspecialchars($_POST['reponse']);

        if ($information['username'] !== $username) {
            $inscription = $bdd->prepare('INSERT INTO account(nom, prenom, username, password, question, reponse) VALUES(:nom, :prenom, :username, :password, :question, :reponse)');
            $inscription->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'username' => $username,
                'password' => $pass_hache,
                'question' => $question,
                'reponse' => $reponse
            ));
        } else {
            echo 'Username déjà utilisé';
        }
    }
}
header('location:login.php');
die;
?>