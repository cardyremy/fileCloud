<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    01.06.2017
// But:     Mettre a jour le flag
//*********************************************************/

//inclusion classe
include_once ('include/dbFunction.inc.php');

//déclaration nouvelle instance
$dbConnect = new dbfunction();

//appel fonction
$restoreFlag = $dbConnect->updateFlagRestoreFile();

//redirection page
header('Refresh:0 folderPage.php');