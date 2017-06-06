<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    23.05.2017
// But: Confirmation du mail
//*********************************************************/

include_once ('include/dbFunction.inc.php');

//déclaration nouvelle instance
$dbConnect = new dbfunction();

//Déclaration variables email et key
$email = $_GET['email'];
$key = $_GET['key'];

//Appel fonction tokencheck
$checkToken = $dbConnect->tokenCheck($email);


for($i=0;$i<count($checkToken);$i++)
{
    //Comparaison du token recu par email avec celui de la BD
    if($checkToken[$i]['useToken'] == $key)
    {
        $confirmEmail = $dbConnect->updateConfirmKey($email);
        header('Refresh:0 loginForm.php');

    }
    else
    {
        echo 'erreur';
    }

}


