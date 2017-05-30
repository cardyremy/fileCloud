<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 29.05.2017
 * Time: 09:02
 */
include_once ('include/dbFunction.inc.php');

$useEmail = $_GET['email'];

$dbConnect = new dbfunction();
$useLogin = 0;
$updateUserAttemp = $dbConnect->updateUserLoginAttemps($useLogin,$useEmail);


header('Location: loginForm.php');