<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    15.05.2017
// But:     Renommer un dossier
//*********************************************************/
include ('include/dbFunction.inc.php');

//Nouvelle instance
$dbConnect = new dbfunction();

//Déclaration variables
$folderName = $_POST['folName'];
$idFolder = $_POST['idFolder'];

//Mets à jour le nom du dossier
$updateFolder = $dbConnect->updateFolder($folderName,$idFolder);

?>

<?php



echo "Veuillez patienter...";
header('Refresh:1 folderPage.php?id='.$idFolder.'')

?>