<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    19.05.17
// But:     Déplacement des fichiers
//*********************************************************/
//inclusion class
include_once ('include/dbFunction.inc.php');

//déclaration variable id
$idFile = $_POST['id'];
//déclaration variable
$folderDestination = $_POST['destinationFolder'];

//Déclaration nouvelle instance
$dbConnect = new dbfunction();

//appel fonctions
$updateDbForMove = $dbConnect->updateFileMove($folderDestination,$idFile);
$updateCheck = $dbConnect->updateFolderFileCheck(1,$folderDestination);

//message de déplacement
echo"En cours de déplacement...";

header('Refresh:1 folderPage.php');
