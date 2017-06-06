<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    19.05.2017
// But:     Créaion de zip automatique
//*********************************************************/
//déclaration variables
$filePath = $_POST['filePath'];
$fileName = $_POST['fileName'];

$zip = new ZipArchive;
//création zip
 ($zip->open('../Files/'.$fileName.'.zip',ZipArchive::CREATE));
    $zip->addFile($filePath, '');
    $zip->close();

//redirection
header('Refresh :0  ../Files/'.$fileName.'.zip');
