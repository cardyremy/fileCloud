<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 01.06.2017
 * Time: 11:18
 */

include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();

$loadFromFlag = $dbConnect->deleteFilePermanently();

header('Refresh:0 folderPage.php');
