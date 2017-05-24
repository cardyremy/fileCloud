<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 24.05.2017
 * Time: 13:58
 */

include_once 'include/dbFunction.inc.php';
$dbConnect = new dbfunction();

$newPassword = $_POST['pwd1'];
$retypePassword = $_POST['pwd2'];
$email = $_POST['email'];

if($newPassword==$retypePassword)
{
    if(preg_match('#\d#',$newPassword))
    {
        if (preg_match('#[a-z]#', $newPassword))
        {
            if (preg_match('#[A-Z]#', $newPassword))
            {
                if (preg_match('#[^ \w]#', $newPassword))
                {
                    //Verifie la longeur
                    if (strlen($newPassword) >= 12)
                    {
                        $hashedPwd = password_hash($newPassword,PASSWORD_DEFAULT);
                        $updatePassword = $dbConnect->updateUserPassword($hashedPwd,$email);
                        echo 'Le mot de passe a été mis à jour avec succès !';
                        header('Refresh:2 loginForm.php');
                    }
                    else
                    {
                        echo'Veuillez introduire au minimum 12 caractères !';
                        header("Refresh:2 forgotPasswordForm.php");
                    }
                }
                else
                {
                    echo'Veuillez introduire un caractère spécial !';
                    header('Refresh:2 forgotPasswordForm.php');
                }
            }
            else
            {
                echo'Veuillez introduire une majuscule!';
                header('Refresh:2 forgotPasswordForm.php');
            }
        }
        else
        {
            echo'Veuillez introduire une minuscule!';
            header('Refresh:2 forgotPasswordForm.php');
        }
    }
    else
    {
        echo'Veuillez introduire un chiffre!';
        header('Refresh:2 forgotPasswordForm.php');
        //header('Refresh:2 index.php');
    }
}
else
{
    echo "Veuillez reintroduire votre mot de passe !";
    header('Refresh:2 forgotPasswordForm.php');

}