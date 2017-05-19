<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 19.05.2017
 * Time: 08:40
 */
include_once ('include/dbFunction.inc.php');

$idFile = $_GET['id'];
$fkFolder = $_GET['fk'];

$dbConnect =new dbfunction();

$loadFilesFromFolder = $dbConnect->fileCheckMoreThanOne($idFile);

for($i=0;$i<count($loadFilesFromFolder);$i++)
{
    $countFilesInFolder= count($loadFilesFromFolder[$i]['fkFolder']);
    if($countFilesInFolder > 1)
    {
        $deleteFile = $dbConnect->deleteFile($idFile);
    }
    else
    {
        $deleteFile = $dbConnect->deleteFile($idFile);
        $folderCheckUpdate = $dbConnect->updateFolderFileCheck('0',$fkFolder);
    }

}

echo 'En cours de suppression...';
header('Refresh:1 folderPage.php');

