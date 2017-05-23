<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    10.05.2017
// But: Page de login du site
//*********************************************************/

include_once('include/header.inc.php');

?>

<link href="../css/foundation.css" rel="stylesheet">
<link href="../css/foundation.min.css" rel="stylesheet" >
<link href="../css/app.css" rel="stylesheet" >

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

<div class="space">

</div>

<div class="row">
    <div class="medium-6  large-4 large-centered columns border-1">

        <form method="POST" action="login.php" name="formLogin">
            <div class="row">
                <h4 class="text-center ">Log in with your Email Address</h4>
                <label>Email Address
                    <div class="input-group">
                    <span class="input-group-label">
                        <i class="fa fa-user"></i>
                    </span>
                        <input class="input-group-field" type="text" placeholder="Email" name="userEmail">
                    </div>
                </label>
                <label>Password
                    <div class="input-group">
                      <span class="input-group-label">
                            <i class="fa fa-key"></i>
                      </span>
                        <input class="input-group-field" type="password" placeholder="Password" name="password">
                    </div>
                </label>
                <input class="button expanded"  type="submit" name="btnLogin" value="Log In" />
                <p class="text-center"><a href="forgotPasswordForm.php">Forgot your password?</a></p>
                <p class="text-center"><a href="index.php">Create an account</a></p>
            </div>
        </form>

    </div>
</div>

    <div class="space">

    </div>
    <div class="neat-article-image">
        <img src="../img/data.jpeg">
    </div>
<?php

include_once('include/footer.inc.php');


?>