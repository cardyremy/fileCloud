<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    10.05.2017
// But: Page d'accueil du site
//*********************************************************/
include_once('include/header.inc.php');

include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();
$loadUserData = $dbConnect->selectAllUser();

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

<div class="row ">
    <div class="small-4 small-centered columns text-center">
        <form action="signUp.php" method="post">
            <div class="form-icons">
                <h4>Register for an account</h4>

                <div class="input-group">
                    <span class="input-group-label">
                        <i class="fa fa-user"></i>
                    </span>
                    <input class="input-group-field" type="text" placeholder="Full name" name="name" required>
                </div>

                <div class="input-group">
                      <span class="input-group-label">
                            <i class="fa fa-envelope"></i>
                      </span>
                      <input class="input-group-field" type="text" placeholder="Email" name="email" required>
                </div>

                <div class="input-group">
                      <span class="input-group-label">
                            <i class="fa fa-key"></i>
                      </span>
                      <input class="input-group-field" type="password" placeholder="Password" name="password" required>
                </div>
            </div>
            <a href="loginForm.php">Click here if you are already a member </a><br>
            <button class="button expanded">Sign Up</button>
        </form>

    </div>
    <div class="space">

    </div>
</div>
<div class="neat-article-image">
    <img src="../img/data.jpeg">
</div>


</body>
</html>

<?php

include_once ('include/footer.inc.php');
?>



