<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    24.05.2017
// But:
//*********************************************************/
include_once ('include/dbFunction.inc.php');
$dbConnect = new dbfunction();

$key = $_GET['key'];
$email = $_GET['email'];

$loadKeyFromDB = $dbConnect-> sendRequestUser($email);
$keyLoad = $loadKeyFromDB[0]['useToken'];

if($keyLoad==$key)
{
include_once ('include/header.inc.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FileCloud</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

    <link href="../css/foundation.css" rel="stylesheet" media="all">
    <link href="../css/foundation.min.css" rel="stylesheet" media="all">
    <link href="../css/app.css" rel="stylesheet" media="all">

</head>
<body>

<div class="space">

</div>

<div class="row">
    <div class="medium-6  large-4 large-centered columns border-1">

        <form method="POST" action="newPasswordSet.php" >
            <div class="row">
                <h4 class="text-center ">Set your new password</h4>
                <label>Password
                    <div class="input-group">
                      <span class="input-group-label">
                            <i class="fa fa-key"></i>
                      </span>
                        <input class="input-group-field" type="password" placeholder="Password" name="pwd1">
                    </div>
                </label>
                <label>Retype your Password
                    <div class="input-group">
                      <span class="input-group-label">
                            <i class="fa fa-key"></i>
                      </span>
                        <input class="input-group-field" type="password" placeholder="Password" name="pwd2">
                    </div>
                </label>
                <input name="email" type="hidden" value="<?php echo $email ?>">
                <input name="key" type="hidden" value="<?php echo $key ?>">
                <input class="button expanded"  type="submit" name="btnLogin" value="Save" />
            </div>
        </form>

    </div>
</div>

<div class="space">

</div>


</body>

</html>




<?php



include_once ('include/footer.inc.php');


}
else
{
    echo "Une erreur de confirmation c'est produite, veuillez reessayer !";
}