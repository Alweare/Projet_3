<?php

session_start();
// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();
//On revnvoit à la page login après avoir détruit la session.
header('location:login.php');
?>