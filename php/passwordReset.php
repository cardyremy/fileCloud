<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 23.05.2017
 * Time: 13:40
 */

include_once ('include/dbFunction.inc.php');
$dbConnect = new dbfunction();

$email = $_POST['userEmail'];

$loadKeyForPassword = $dbConnect->sendRequestUser($email);
$key =  $loadKeyForPassword[0]['useToken'];

//Verifie le bon format de l'email
if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email))
{

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


    $mail->Body = '<a href="http://127.0.0.1/projects/FileCloud/php/pswResetConfirm.php?email='.urlencode($email).'&key='.$key.'">Veuillez cliquer sur ce lien pour reinitialiser votre mot de passe ! </a>';
//send the message, check for errors
    $mail->send();
    if (!$mail->send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;

    } else
    {
        echo "En cours d'envoi... ";
        header ("Refresh:2 index.php");
    }



}