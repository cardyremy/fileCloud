<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    29.05.2017
// But:  Débloquer un utilisateur bloqué après 5 tentaives de connection erronés
//*********************************************************/
include_once ('include/dbFunction.inc.php');

//declaration variable email
$useEmail = $_GET['email'];

//Déclaration nouvelle instance
$dbConnect = new dbfunction();
$useLogin = 0;

//Appel fonction
$updateUserAttemp = $dbConnect->updateUserLoginAttemps($useLogin,$useEmail);

//inclusion header
header('Location: loginForm.php');