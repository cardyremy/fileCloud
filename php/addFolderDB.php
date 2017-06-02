<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    15.05.2017
// But: Ajouter un dossier à la base de donnée
//*********************************************************/
include_once ('include/dbFunction.inc.php');

//Debut de session
session_start();


$dbConnect = new dbfunction();

//Variable email
$user = $_SESSION['useEmail'];
$selectUser = $dbConnect->sendRequestUser($user);
$idUser = $selectUser[0]['idUser'];

//Recuperation du formulaire
$folName = $_POST['folName'];
$folderId = $_POST['idFolder'];


$dbConnect = new dbfunction();

$insertFolderIntoDb = $dbConnect->insertFolder($folName,$folderId,$idUser);


echo "En cours d'ajout...";
//Redirection sur le dossier créé
header('Refresh:2 folderPage.php?id='.$folderId.'');
