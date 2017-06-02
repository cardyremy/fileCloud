<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    29.05.2017
// But:  Débloquer un utilisateur bloqué après 5 tentaives de connection erronés
//*********************************************************/
include_once ('include/dbFunction.inc.php');

$useEmail = $_GET['email'];

$dbConnect = new dbfunction();
$useLogin = 0;
$updateUserAttemp = $dbConnect->updateUserLoginAttemps($useLogin,$useEmail);


header('Location: loginForm.php');