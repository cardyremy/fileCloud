<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 15.05.2017
 * Time: 10:52
 */

include ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();
$folderName = $_POST['folName'];
$idFolder = $_POST['idFolder'];


$updateFolder = $dbConnect->updateFolder($folderName,$idFolder);

?>

<?php



echo "Veuillez patienter...";
header('Refresh:1 folderPage.php?id='.$idFolder.'')

?>