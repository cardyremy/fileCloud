<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 17.05.2017
 * Time: 13:24
 */


include_once ('include/dbFunction.inc.php');

$idFolder = $_POST['idFolder'];
$destinationFolder = $_POST['destinationFolder'];
$folderName = $_POST['folName'];


$objConnect = new dbfunction();

$moveFolder = $objConnect-> moveFolder($folderName,$destinationFolder,$idFolder);

$moveFile = $objConnect-> moveFile($idFolder,$destinationFolder);

echo "En cours de déplacement...";
header('Refresh:1 folderPage.php');