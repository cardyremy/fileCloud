<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    18.05.2017
// But: Page contenant les dossiers des utilisateurs
//*********************************************************/

include_once ('include/header.inc.php');
include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();

$idFile = $_GET['id'];

$fileLoadWithID = $dbConnect->selectFileID($idFile);



if(!empty($_GET['id']))
{
    $idFromFolder = $_GET['id'];

}
else
{
    $idFromFolder =1;
}

$loadFolderData = $dbConnect->selectAllFromFolder();

$loadFileData = $dbConnect->selectAllFromFfile($idFromFolder);
$selectFolder = $dbConnect->selectFolder($idFromFolder);
$selectFolderFk = $dbConnect->selectFolderFK($idFromFolder);

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
        <div class="text-center"><p>Bonjour Utilisateur</p></div>

        <div class="medium-6 columns">

        </div>
        <div class="medium-6 columns text-right" style="padding-bottom: 20px">
            <a onclick=" return deleteConf('<?php if (isset($_GET['id'])) { echo $selectFolder[0]['filName']; }?>');" href="deleteFile.php?id=<?php echo $idFile;?>"><img src="../img/delete.ico" style="height: 45px;width: 45px"></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="medium-4 columns " style="padding: 0px">
        <div id="titleHide" class="row">

        </div>
        <div class="row ">

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

                <div class="medium-4 columns ">
                    <?php
                    echo $fileLoadWithID[0]['filName'];
                    ?>
                </div>
                <div class="medium-2 columns">
                    <label>Date 15.07.17</label>
                </div>
                <div class="medium-2 columns">
                    <label>Taille</label>
                </div>
                <div class="medium-2 columns">
                    <?php
                    echo $fileLoadWithID[0]['filTag'];

                    ?>
                </div><br>

            </div>


        </div>
    </div>
</div>
<div class="row">
    <div class="medium-4 columns" style="padding: 0px">


    </div>



    <div class="medium-8 columns"style="padding: 0px">

        <div class="row">

            <div class="small-2">
                <form action="">
                    <a href="../Files/<?php echo $fileLoadWithID[0]['filPath']?>" class="button" download="<?php $fileLoadWithID[0]['filName'] ?>">Download</a>
                </form>
            </div>
            <div class="small-2  ">
                <form action="">
                    <input type="submit" value="    Move   " class="button">
                </form>
            </div>
            <div class="small-2  " >
                <form action="">
                    <input type="submit" value=" Rename " class="button">
                </form>
            </div>

        </div>

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
