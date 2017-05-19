<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 19.05.2017
 * Time: 08:27
 */
include_once ('include/dbFunction.inc.php');

$idFile = $_POST['id'];
$folderDestination = $_POST['destinationFolder'];


$dbConnect = new dbfunction();

$updateDbForMove = $dbConnect->updateFileMove($folderDestination,$idFile);

$updateCheck = $dbConnect->updateFolderFileCheck(1,$folderDestination);

echo"En cours de déplacement...";

header('Refresh:1 folderPage.php');
