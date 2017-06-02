<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    01.06.2017
// But:     Mettre a jour le flag
//*********************************************************/

include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();

$restoreFlag = $dbConnect->updateFlagRestoreFile();

header('Refresh:0 folderPage.php');