<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    01.06.2017
// But:     Supression des fichiers
//*********************************************************/

include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();

$loadFromFlag = $dbConnect->deleteFilePermanently();

header('Refresh:0 folderPage.php');
