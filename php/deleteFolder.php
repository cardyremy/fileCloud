<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    15.05.2017
// But:
//*********************************************************/

include_once ('include/dbFunction.inc.php');

$idFolder = $_GET['id'];

$dbConnect = new dbfunction();

if($idFolder==1)
{
    echo 'Ce dossier ne peut pas etre supprimé !';
    header('Refresh:2 folderPage.php');
}
else
{
    $deleteFolder = $dbConnect->deleteFolder($idFolder);

    echo "En cours de suppression...";

    header('Refresh:2 folderPage.php');

}

