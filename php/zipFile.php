<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 19.05.2017
 * Time: 13:26
 */

$filePath = $_POST['filePath'];
$fileName = $_POST['fileName'];

$zip = new ZipArchive;
 ($zip->open('../Files/'.$fileName.'.zip',ZipArchive::CREATE));
    $zip->addFile($filePath, '');
    $zip->close();


header('Refresh :0  ../Files/'.$fileName.'.zip');
