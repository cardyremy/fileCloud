<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    15.05.2017
// But:     Mettre à jour le flag de suppression dans la base de donné
//*********************************************************/

//inclusion classe dbFunction
include_once ('include/dbFunction.inc.php');

//déclaration variable
$idFolder = $_GET['id'];

//déclaration nouvelle instance
$dbConnect = new dbfunction();

//empeche de supprimer le dossier racine
if($idFolder==1)
{
    echo 'Ce dossier ne peut pas etre supprimé !';
    header('Refresh:2 folderPage.php');
}
else
{   //déclaration date
    $date = new DateTime();
    $today= $date->format('U') . "\n";


    //$deleteFolder = $dbConnect->deleteFolder($idFolder);
    $updateFlag = $dbConnect->updateFlagDeleted($today,$idFolder);

    //Message de suppression
    echo "En cours de suppression...";

    //redirection
    header('Refresh:2 folderPage.php');

}

