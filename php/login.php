<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 22.05.2017
 * Time: 08:28
 */

include_once ('include/dbFunction.inc.php');
$dbConnect = new dbfunction();
$pass= password_hash('.Etml-',PASSWORD_DEFAULT);
$userEmail = htmlentities($_POST['userEmail']);
$pwd = htmlentities($_POST['password']);

$userConnect = $dbConnect->sendRequestUser($userEmail);
$userCheck = $dbConnect->usernameCheck($userEmail);
$error=''; // Variable d'erreur
$msg="";





if($_COOKIE['verif'] <3)
{
    if (isset($_POST))
    {
        if (empty($userEmail) || empty($pwd))
        {
            $msg = "Veuillez introduire votre nom d'utilisateur et mot de passe !";
            header('Location:loginForm.php?msg='.htmlspecialchars($msg));

        }
        else if(empty($userCheck[0]['useEmail']))
        {
            $msg = "L'utilisateur n'existe pas!";
            header('Location:loginForm.php?msg='.htmlspecialchars($msg));
        }
        else if($userConnect[0]['useConfirm'] != 1)
        {
            $msg= 'Lutilisateur nas pas encore été confirmé ! Veuillez verifier votre boite email';
            header('Location:loginForm.php?msg='.htmlspecialchars($msg));
        }
        else
        {
            if(!empty($userConnect))
            {
                if(password_verify($pwd,$userConnect[0]['usePassword']))
                {
                    session_start();
                    //print 'Bienvenue !';
                    $_SESSION['useEmail']= $userEmail;
                    $_SESSION['usePassword']= $userConnect[0]['usePassword'];
                    // $_SESSION['useRights'] = $userConnect[0]['useRights'];
                    $msg = "Bienvenue";
                    header('Location:folderPage.php?msg='.htmlspecialchars($msg));
                    fopen('mailTest.php','r');
                }else
                {
                    if(isset($_COOKIE['login']))
                    {
                        if($_COOKIE['login'] < 3){
                            $attempts = $_COOKIE['login'] + 1;
                            setcookie('login', $attempts);
                        } else{
                            $msg = 'Vous avez atteint le max ';
                            header('Location:loginForm.php?msg='.htmlspecialchars($msg));
                        }
                    } else{
                        setcookie('login', 1);
                        $msg = 'mot de passe incorrect';
                        header('Location:loginForm.php?msg='.htmlspecialchars($msg));
                    }

                }
            }
            else
            {
                //header('Location:../folderPage.php');
                $msg="Nom d'utilisateur ou mot de passe incorrect !";
                header('Location:loginForm.php?msg='.htmlspecialchars($msg));
            }

        }
    }
}
else
{
    $msg="3 de trop!";
    header('Location:loginForm.php?msg='.htmlspecialchars($msg));

}


