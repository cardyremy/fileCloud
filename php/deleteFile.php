<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    19.05.2017
// But:     Met à jour le flag de suppression dans la base de donnée
//*********************************************************/


include_once ('include/dbFunction.inc.php');

$idFile = $_GET['id'];
$fkFolder = $_GET['fk'];

$dbConnect =new dbfunction();

/*
$loadFilesFromFolder = $dbConnect->fileCheckMoreThanOne($idFile);
$loadFilePath = $dbConnect->selectFileID($idFile);


for($i=0;$i<count($loadFilesFromFolder);$i++)
{
    $countFilesInFolder= count($loadFilesFromFolder[$i]['fkFolder']);
    if($countFilesInFolder > 1)
    {
        $deleteFile = $dbConnect->deleteFile($idFile);

            $path = '../Files/'.$loadFilePath[0]['filPath'];
            unlink($path);

    }
    else
    {
        $deleteFile = $dbConnect->deleteFile($idFile);
        $folderCheckUpdate = $dbConnect->updateFolderFileCheck('0',$fkFolder);

            $path = '../Files/'.$loadFilePath[0]['filPath'];
            unlink($path);
    }

}
*/


$updateFlagFile  = $dbConnect->updateFlagFile();


echo 'En cours de suppression...';
header('Refresh:1 folderPage.php');

