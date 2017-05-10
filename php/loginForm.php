<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    10.05.2017
// But: Page de login du site
//*********************************************************/


include_once('include/header.inc.php');


?>

<link href="../css/foundation.css" rel="stylesheet" media="all">
<link href="../css/foundation.min.css" rel="stylesheet" media="all">
<link href="../css/app.css" rel="stylesheet" media="all">

<div class="space">

</div>

<div class="row">
    <div class="medium-6 medium-centered large-4 large-centered columns border-1">

        <form method="POST" action="login.php" id="login" name="formLogin">

            <div class="row column log-in-form">
                <h4 class="text-center">Log in with your username</h4>
                <label>Username
                    <input name="strLogin" type="text" placeholder="Username">
                </label>
                <label>Password
                    <input id="pwd" name="pwd" type="password" placeholder="Password">
                </label>
                <input id="show-password" type="checkbox"><label for="show-password">Show password</label>
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