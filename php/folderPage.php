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

$idFromFolder = $_GET['id'];


$loadFolderData = $dbConnect->selectAllFromFolder();


$loadFileData = $dbConnect->selectAllFromFfile($idFromFolder);


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
    <div class="medium-6 columns " style="padding: 0px">
        <h5 class="text-center"> <?php

            for($x=0;$x<count($loadFolderData);$x++)
            {
                echo $loadFolderData[$x]['folName'];
            }

              ?></h5>
        <img src="../img/folderClose.png">
    </div>
    <div class="medium-6 columns " style="padding: 0px">
            <div class="row">
                <div class="white">
                    <div class="medium-4 columns " >
                        <p>Name</p>
                    </div>
                    <div class="medium-4 columns ">
                        <p>Type</p>
                    </div>
                    <div class="medium-4 columns ">
                        <p>Taille</p>
                    </div>
                    <div class="medium-4 columns ">
                        <?php
                        for($i=0;$i<count($loadFolderData);$i++)
                        {
                        ?>
                    <img src="../img/folderClose.png" style="height: 25px;width: 25px">
                        <a href="folderPage.php?id=<?php echo $loadFolderData[$i]['idFolder']; ?>"><?php echo $loadFolderData[$i]['folName']; ?></a><br>

                        <?php
                        }
                            for($j=0;$j<count($loadFileData);$j++){
                        ?>

                            <a><?php echo $loadFileData[$j]['filName']; ?></a><br>

                       <?php } ?>

                    </div>
                    <div class="medium-8 columns">
                        <?php

                        //Afiche un trait pour l'extension des dossiers
                        for($j=0;$j<count($loadFolderData);$j++)
                        {
                            $info = new SplFileInfo($loadFolderData[$j]['folName']);
                            $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
                            if(empty($extension))
                            {
                                echo '-';
                            }else
                            {
                                echo $extension;
                            }
                            ?>
                        <br>

                        <?php }
                        //Récupère l'extension pour les fichiers
                        for($j=0;$j<count($loadFileData);$j++)
                        {
                        $info = new SplFileInfo($loadFileData[$j]['filName']);
                        $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
                        if(empty($extension))
                        {
                        echo '-';
                        }else
                        {
                        echo $extension;
                        }
                        ?>
                        <br>

                        <?php } ?>
                    </div>
                </div>
            </div>
    </div>

</div>

<div class="row">

    <div class="medium-6 columns" style="padding: 0px">

    </div>
    <div class="medium-6 columns"style="padding: 0px">
        <label>
            <h4>Upload files</h4>
        </label>

        <form action="uploadFile.php" method="post">
            <label>
                Nom de l'image
            </label>
            <input type="text" name="nom" placeholder="Name">
            <label>
                Maximum 500Mo
            </label>
            <input type="file" id="fileUpload" name="file">
            <input type="submit" value="submit">
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
