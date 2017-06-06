<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    22.05.2017
// But:     Login de l'utilisateur
//*********************************************************/
include_once ('include/dbFunction.inc.php');

//Declaration nouvelle instance
$dbConnect = new dbfunction();
//Hashage du mot de passe
$pass= password_hash('.Etml-',PASSWORD_DEFAULT);

//declaration variables
$userEmail = htmlentities($_POST['userEmail']);
$pwd = htmlentities($_POST['password']);

//Affiche les informations de l'utilisateur
$userConnect = $dbConnect->sendRequestUser($userEmail);
//appel fonction de verification email
$userCheck = $dbConnect->usernameCheck($userEmail);
$error=''; // Variable d'erreur
$msg="";
$userLoginCheck = $dbConnect->sendRequestUser($userEmail);
$checkLoginAttemp = $userLoginCheck[0]['useLoginAttemp'];

setcookie('login', $userEmail);

    //Verifie que les champs on été remplis
    if (isset($_POST))
    {
        //Verifie les champ du mail et du mot de passe
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
        //Verifi si l'utilisateur est confirmé
        else if($userConnect[0]['useConfirm'] != 1)
        {
            $msg= 'Lutilisateur nas pas encore été confirmé ! Veuillez verifier votre boite email';
            header('Location:loginForm.php?msg='.htmlspecialchars($msg));
        }
        else
        {
            if(!empty($userConnect))
            {
                //Vérifie le mot de passe
                if(password_verify($pwd,$userConnect[0]['usePassword']))
                {
                    session_start();

                    //Déclaration variables de session
                    $_SESSION['useEmail']= $userEmail;
                    $_SESSION['usePassword']= $userConnect[0]['usePassword'];
                    $msg = "Bienvenue";
                    header('Location:selectedFile.php?id=1');


                }else
                {
                    //Verifie le nombre de connections erronés
                    if($checkLoginAttemp < 5)
                    {

                        $checkLoginAttemp = $checkLoginAttemp+1;
                        $updateAttemp = $dbConnect->updateUserLoginAttemps($checkLoginAttemp,$userEmail);
                        $msg = 'mot de passe incorrect';
                        header('Location:loginForm.php?msg='.htmlspecialchars($msg).'&email='.$userEmail.'');


                        /*if($_COOKIE['login'] < 3){
                            $attempts = $_COOKIE['login'] + 1;
                            setcookie('login', $attempts);
                            $msg = 'mot de passe incorrect';
                            header('Location:loginForm.php?msg='.htmlspecialchars($msg));
                        } else{
                            $msg = 'Vous avez atteint le max ';
                            header('Location:loginForm.php?msg='.htmlspecialchars($msg));
                        }*/

                    }
                    //Envoie du mail pour débloquer le compte
                    else
                    {
                        $msg = "L'utilisateur a été bloqué, un email pour débloquer la session a été envoyé";
                        header('Location:loginForm.php?msg='.htmlspecialchars($msg).'&email='.$userEmail.'');

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
                        $mail->addAddress($userEmail, '');
                        //Set the subject line
                        $mail->Subject = 'Unlock account';
                        $mail->addCustomHeader('MIME-Version: 1.0');
                        $mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');


                        $mail->Body = '<a href="http://127.0.0.1/projects/FileCloud/php/deblockUser.php?email='.urlencode($userEmail).'">Veuillez cliquer sur ce lien pour débloquer votre Compte </a>';
//send the message, check for errors
                        if (!$mail->send()) {
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        } else {
                            header('Refresh:0 loginForm.php');
                        }
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



