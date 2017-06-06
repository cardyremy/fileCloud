<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    19.05.2017
// But:     Renommer les fichiers
//*********************************************************/

include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();

//Déclaration variables
$fileName = $_POST['filName'];
$idFile = $_POST['idFile'];

//appel fonction
$renameFile = $dbConnect->updateFile($fileName,$idFile);

//Message de modification
echo'En cours de modification...';

header('Refresh:1 folderPage.php');

