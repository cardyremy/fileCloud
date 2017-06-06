<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    17.05.2017
// But:     Deplacement dossiers
//*********************************************************/

//inclusion classe
include_once ('include/dbFunction.inc.php');

//déclaration variables
$idFolder = $_POST['idFolder'];
$destinationFolder = $_POST['destinationFolder'];
$folderName = $_POST['folName'];

//déclaration nouvelle instance
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

//message de déplacement
echo "En cours de déplacement...";
header('Refresh:1 folderPage.php');