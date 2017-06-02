<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    19.05.2017
// But:     Créaion de zip automatique
//*********************************************************/
$filePath = $_POST['filePath'];
$fileName = $_POST['fileName'];

$zip = new ZipArchive;
 ($zip->open('../Files/'.$fileName.'.zip',ZipArchive::CREATE));
    $zip->addFile($filePath, '');
    $zip->close();


header('Refresh :0  ../Files/'.$fileName.'.zip');
