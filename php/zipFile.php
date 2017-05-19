<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 19.05.2017
 * Time: 13:26
 */

$filePath = $_POST['filePath'];

$zip = new ZipArchive;
 ($zip->open('../Files/test.zip',ZipArchive::CREATE));
    $zip->addFile($filePath, '');
    $zip->close();

header('Location :../Files/test.zip');
