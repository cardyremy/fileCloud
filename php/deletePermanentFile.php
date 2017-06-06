<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    01.06.2017
// But:     Supression des fichiers
//*********************************************************/

//inclusion classe
include_once ('include/dbFunction.inc.php');

//déclaration nouvelle instance
$dbConnect = new dbfunction();

//appel fonction
$loadFromFlag = $dbConnect->deleteFilePermanently();

//redirection
header('Refresh:0 folderPage.php');
