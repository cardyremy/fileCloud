
<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    11.05.2017
// But: Page contenant les dossiers des utilisateurs
//*********************************************************/

//inclusuion fichiers
include_once ('include/header.inc.php');
include_once ('include/dbFunction.inc.php');

//déclaration nouvelle instance
$dbConnect = new dbfunction();


//Id dossier racine
if(!empty($_GET['id']))
{
    $idFromFolder = $_GET['id'];

}
else
{
    $idFromFolder =1;
}

//Déclaration variables
$tag = $_POST['tag'];

$email = $_SESSION['useEmail'];

//appel fonction
$userId = $dbConnect->sendRequestUser($email);
$id = $userId[0]['idUser'];
//appel fonction
$loadTagData = $dbConnect->sendRequestTag($tag,$id);
//appel fonction
$loadFolderTag = $dbConnect->sendRequestTag($tag,$id);


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
    <script src="../js/deleteConfirm.js"></script>
</head>
<body>

<div class="space">
    <div class="row">
        <div class="text-center"><p>Bonjour <?php echo $_SESSION['useEmail'] ?></p></div>

        <div class="medium-6 columns">

        </div>

    </div>
</div>

<div class="row">
    <div class="medium-4 columns " style="padding: 0px">
        <div id="titleHide" class="row">

        </div>

        <div class="medium-10">
            <img src="../img/folderClose.png" >
        </div>

    </div>
    <div class="medium-8 columns " style="padding: 0px">
        <div class="row">
            <div class="white">
                <div class="medium-4 columns " >
                    <p>Name</p>
                </div>
                <div class="medium-2 columns ">
                    <p>Date</p>
                </div>
                <div class="medium-2 columns ">
                    <p>Taille</p>
                </div>
                <div class="medium-2 columns ">
                    <p>Tag</p>
                </div>

                <div class="medium-6 columns ">
                    <?php
                    for($j=0;$j<count($loadTagData);$j++){
                        ?>

                        <a href="fileDetails.php?id=<?php echo $loadTagData[$j]['idFile'];?>"> <?php echo $loadTagData[$j]['filName'];?></a>
                        <br>
                    <?php }
                    ?>

                </div>
                <div class="medium-4 columns">

                </div>
                <div>
                    <?php
                    /*for($u=0;$u<count($loadFileData);$u++){
                        $date = $loadFileData[$u]['filName'];
                        echo "$date".date("D d Y H:i:s.", filectime($date));
                    }*/
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="medium-4 columns" style="padding: 0px">

    </div>

</div>

<div class="space">

</div>
</body>
</html>

<script src="../js/renameHide.js"></script>



<?php

include_once ('include/footer.inc.php');


?>
