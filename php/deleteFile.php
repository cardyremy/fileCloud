<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    19.05.2017
// But:     Met à jour le flag de suppression dans la base de donnée
//*********************************************************/

//inclusion de la classe
include_once ('include/dbFunction.inc.php');

//déclaration variable id et fk
$idFile = $_GET['id'];
$fkFolder = $_GET['fk'];

//déclaration nouvelle instance
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


//appel fonction
$updateFlagFile  = $dbConnect->updateFlagFile();

//message de suppression
echo 'En cours de suppression...';

//redirection
header('Refresh:1 folderPage.php');

