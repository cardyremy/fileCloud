<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    22.05.2017
// But:     Création login et envoie email pour confirmation
//*********************************************************/
include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();

$fullName = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];


$emailCheck = $dbConnect->emailCheckUser($email);


if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email))
{
    if(count($emailCheck)>0)
    {
        echo "Cette adresse éléctronique est déja assigné a un autre compte, veuillez introduire une autre adresse email";
        header('Refresh:2 index.php');
    }
    else
    {
        if(preg_match('#\d#',$password))
        {
            if(preg_match('#[a-z]#',$password))
            {
                if(preg_match('#[A-Z]#',$password))
                {
                    if(preg_match('#[^ \w]#',$password))
                    {
                        //Verifie la longeur
                        if(strlen($password)>=12)
                        {

                            $keyLength= 15;
                            $key='';
                            for($i=0;$i<$keyLength;$i++)
                            {
                                $key.= mt_rand(0,9);
                            }

                            //SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
                            date_default_timezone_set('Etc/UTC');
                            require '../PHPMailer-master/PHPMailerAutoload.php';
//Create a new PHPMailer instance
                            $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
                            $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
                            $mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
                            $mail->Debugoutput = 'html';
//Set the hostname of the mail server
                            $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                            $mail->Port = 587; //587;
//Set the encryption system to use - ssl (deprecated) or tls
                            $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
                            $mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
                            $mail->Username = "labmac512@gmail.com";
//Password to use for SMTP authentication
                            $mail->Password = "cambal512";
//Set who the message is to be sent from
                            $mail->setFrom('fileCloud@contact.com', 'fileCloud');
//Set an alternative reply-to address
                            $mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
                            $mail->addAddress($email, '');
//Set the subject line
                            $mail->Subject = 'Link Email Confirmation';
                            $mail->addCustomHeader('MIME-Version: 1.0');
                            $mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');


                            $mail->Body = '<a href="http://127.0.0.1/projects/FileCloud/php/confirmMail.php?email='.urlencode($email).'&key='.$key.'">Veuillez cliquer sur ce lien pour confirmer votre inscription </a>';
//send the message, check for errors
                            if (!$mail->send()) {
                                echo "Mailer Error: " . $mail->ErrorInfo;
                            } else {
                                header('Refresh:0 loginForm.php');
                            }
                            $hashedPwd = password_hash($password,PASSWORD_DEFAULT);

                            $tokenUpdate = $dbConnect->newUser($fullName,$email,$hashedPwd,$key);

                        }
                        else
                        {
                            echo "Veuillez introduire au moin 12 caractères !";
                            header('Refresh:2 index.php');
                        }
                    }
                    else
                    {

                        echo'Veuillez introduire au moin un caractère spécial';
                        header('Refresh:2 index.php');

                    }
                }
                else
                {
                    echo'Veuillez introduire une majuscule';
                    header('Refresh:2 index.php');

                }
            }
            else
            {
                echo'Veuillez introduire une minuscule';
                header('Refresh:2 index.php');

            }
        }else
        {
            echo'Veuillez introduire un chiffre';
            header('Refresh:2 index.php');

        }
    }
}
else
{
    echo 'Adresse email non valide !';
    header('Refresh:2 index.php');

}


   // header('Location: loginForm.php');


