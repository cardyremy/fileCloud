<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    11.05.2017
// But: Page contenant les dossiers des utilisateurs
//*********************************************************/

include_once ('include/header.inc.php');
include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();
$loadFolderData = $dbConnect->selectAllFromFolder();

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
    <div class="row">
        <div class="text-center"><p>Bonjour Utilisateur</p></div>

        <div class="medium-6 columns">

        </div>
        <div class="medium-6 columns text-right" style="padding-bottom: 20px">
            <a href="#"><img src="../img/addFold2.png" style="height: 45px;width: 45px"></a>
            <a href="#"><img src="../img/edit.ico" style="height: 45px;width: 45px"></a>
            <a href="#"><img src="../img/delete.ico" style="height: 45px;width: 45px"></a>
        </div>

    </div>

</div>

<div class="row">
    <div class="medium-6 columns ">
        <h5 class="text-center"> <?php echo $loadFolderData[0]['folName'];  ?></h5>
        <img src="../img/folderClose.png">
    </div>
    <div class="medium-6 columns ">
        <div class="white">
        <?php echo $loadFolderData[0]['folName'];  ?>


        </div>

    </div>


</div>

<div class="space">

</div>
</body>
</html>







<?php

include_once ('include/footer.inc.php');


?>
