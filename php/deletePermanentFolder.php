<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    01.06.2017
// But:     Supression des dossiers
//*********************************************************/

//inclusion classe
include_once ('include/dbFunction.inc.php');

//déclaration nouvelle instance
$dbConnect = new dbfunction();

//appel fonction de suppression
$loadFromFlag = $dbConnect->deleteFolderPermanently();

//redirection
header('Refresh:0 folderPage.php');
