<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    23.05.2017
// But:     Form pour reinitialiser le mot de passe
//*********************************************************/
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

        <form method="POST" action="passwordReset.php" >
            <div class="row">
                <h4 class="text-center ">Enter your New Password</h4>
                <label>New Password
                    <div class="input-group">
                      <span class="input-group-label">
                            <i class="fa fa-key"></i>
                      </span>
                        <input class="input-group-field" type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="input-group">
                      <span class="input-group-label">
                            <i class="fa fa-key"></i>
                      </span>
                        <input class="input-group-field" type="password" placeholder="Password" name="passwordConfirm" required>
                    </div>
                </label>
                <input class="button expanded"  type="submit" name="btnLogin" value="Reset" />
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

?>
