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

$folderCheck = $objConnect->selectAllFromFolder();

for($i=0;$i<count($folderCheck);$i++)
{
    //Verifie si le dossier contient des fichiers
     if($folderCheck[$i]['folFileCheck']==1)
     {
         $moveFolder = $objConnect-> moveFolder($folderName,$destinationFolder,$idFolder);

         $moveFile = $objConnect-> moveFile($idFolder,$destinationFolder);
     }
    else
    {
        $moveFolder = $objConnect-> moveFolder($folderName,$destinationFolder,$idFolder);
    }
}


echo "En cours de déplacement...";
header('Refresh:1 folderPage.php');