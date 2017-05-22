<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    15.05.2017
// But:
//*********************************************************/
include_once ('include/dbFunction.inc.php');

session_start();

$dbConnect = new dbfunction();

$user = $_SESSION['useEmail'];
$selectUser = $dbConnect->sendRequestUser($user);
$idUser = $selectUser[0]['idUser'];


$folName = $_POST['folName'];
$folderId = $_POST['idFolder'];


$dbConnect = new dbfunction();

$insertFolderIntoDb = $dbConnect->insertFolder($folName,$folderId,$idUser);


echo "En cours d'ajout...";
//Redirection sur le dossier créé
header('Refresh:2 folderPage.php?id='.$folderId.'');
