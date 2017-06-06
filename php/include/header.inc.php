<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    10.05.2017
// But: Header du site
//*********************************************************/

session_start();


//Deconnection du login au bout de 5min

//Déclaration variable temps
$inactive = 300;

//Vérification de variable session timout
if( !isset($_SESSION['timeout']) )
    $_SESSION['timeout'] = time() + $inactive;

//déclaration varriable session_lofe
$session_life = time() - $_SESSION['timeout'];

if($session_life > $inactive)
{  $msg = "Expiration de la session";
    session_destroy(); header('Location:index.php');     }

$_SESSION['timeout']=time();

include_once ('dbFunction.inc.php');

$dbConnect = new dbfunction();

//$email=$_SESSION['useEmail'];
//$getId = $dbConnect->sendRequestUser($email);
 //$idUser = $getId[0]['idUser'];
/*
$tag = $_POST['tag'];
$userTag = $dbConnect->sendRequestTag($tag,$idUser);
*/
?>

<link href="../../css/foundation.css" rel="stylesheet" >
<link href="../../css/foundation.min.css" rel="stylesheet" >
<link href="../../css/app.css" rel="stylesheet">

    <div class="background">

        <div class="row">

            <div class="medium-1 columns" style="padding: 0px">

                <?php
                //Redirection en fonction de login
                if(!isset($_SESSION['useEmail']))
                {
                    echo' <a href="index.php"><h4>FileCloud</h4></a>';
                }
                else
                {
                    echo' <a href="folderPage.php"><h4>FileCloud</h4></a>';
                }
                ?>

            </div>
            <div class="medium-1 columns text-left">

                <?php
                //Redirection en fonction de login
                if(!isset($_SESSION['useEmail']))
                {
                    echo'<a href="index.php"><img src="../img/cloudLogo.png" style="width: 35px;height: 35px"></a>';
                }
                else
                {
                    echo'<a href="folderPage.php"><img src="../img/cloudLogo.png" style="width: 35px;height: 35px"></a>';
                }
                ?>

            </div>

            <div class="medium-10 columns text-right" style="padding: 0px">
                <?php


                //Redirection en fonction de login
                if(!isset($_SESSION['useEmail']))
                {
                ?>
                    <a href="loginForm.php" class="button">LogIn</a>
                    <a href="index.php" class="button">Sign Up</a>

                    <?php
                }
                else
                {
                ?>
                    <a href="deconnection.php" class="button">LogOut</a>
                    <?php

                }
                ?>

            </div><br>

            <?php
            if(isset($_SESSION['useEmail']))
             {

            ?>
                <div class="row">
                    <div class="medium-12 columns" style="padding: 0px">
                        <form method="post" action="../php/searchResult.php">

                        <div class="input-group input-group-rounded">
                                <input class="input-group-field" type="search" name="tag">
                                <div class="input-group-button">
                                    <input type="submit" class="button secondary" value="Search">
                                </div>

                        </div>
                        </form>
                    </div>

                </div>
            <?php
             } ?>

        </div>


    </div>



