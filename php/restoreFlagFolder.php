<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 01.06.2017
 * Time: 09:59
 */

include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();

$restoreFlag = $dbConnect->updateFlagRestore();

header('Refresh:0 folderPage.php');