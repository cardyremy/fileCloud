<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 19.05.2017
 * Time: 11:55
 */

include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();

$fileName = $_POST['filName'];
$idFile = $_POST['idFile'];


$renameFile = $dbConnect->updateFile($fileName,$idFile);

echo'En cours de modification...';

header('Refresh:1 folderPage.php');

