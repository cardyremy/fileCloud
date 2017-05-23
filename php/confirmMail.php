<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 23.05.2017
 * Time: 10:51
 */
include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();


$email = $_GET['email'];
$key = $_GET['key'];

$checkToken = $dbConnect->tokenCheck($email);


for($i=0;$i<count($checkToken);$i++)
{
    if($checkToken[$i]['useToken'] == $key)
    {
        $confirmEmail = $dbConnect->updateConfirmKey($email);
        header('Refresh:0 loginForm.php');

    }
    else
    {
        echo 'erreur';
    }

}


