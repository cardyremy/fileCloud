<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    19.05.17
// But:     Déplacement des fichiers
//*********************************************************/
include_once ('include/dbFunction.inc.php');

$idFile = $_POST['id'];
$folderDestination = $_POST['destinationFolder'];

//Déclaration nouvelle instance
$dbConnect = new dbfunction();

$updateDbForMove = $dbConnect->updateFileMove($folderDestination,$idFile);

$updateCheck = $dbConnect->updateFolderFileCheck(1,$folderDestination);

echo"En cours de déplacement...";

header('Refresh:1 folderPage.php');
