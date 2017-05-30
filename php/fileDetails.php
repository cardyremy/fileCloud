<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    18.05.2017
// But: Page contenant les dossiers des utilisateurs
//*********************************************************/
header('Content-Type: text/html; charset=utf-8');

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
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.uploadPreview.min.js"></script>
</head>
<body>

<div class="space">
    <div class="row">
        <div class="text-center"><p>Bonjour <?php echo $_SESSION['useEmail'] ?></p></div>

        <div class="medium-6 columns">

        </div>
        <div class="medium-6 columns text-right" style="padding-bottom: 20px">
            <a onclick=" return deleteConfFile('<?php if (isset($idFile)) { echo $fileLoadWithID[0]['filName']; }?>');" href="deleteFile.php?id=<?php echo $idFile;?>&fk=<?php echo $fileLoadWithID[0]['fkFolder'] ?>"><img src="../img/delete.ico" style="height: 45px;width: 45px"></a>
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
                        <label> <?php
                            echo $fileLoadWithID[0]['filName'];
                            ?>

                        </label>
                </div>
                <div class="medium-2 columns">
                    <label><?php
                        $path='../Files/'.$fileLoadWithID[0]['filPath'];
                        echo  date("F d Y H:i:s.", filemtime($path));
                        ?></label>
                </div>
                <div class="medium-2 columns ">
                    <label><?php

                        $size = '../Files/'.$fileLoadWithID[0]['filPath'];
                        $fileSize = filesize($size);
                        //Convertir de bytes en MB
                        $convertedFile = round(($fileSize / 1048576), 2)." MB";
                        echo $convertedFile;

                        ?></label>
                </div>
                <div class="medium-2 columns">
                     <label>
                         <?php
                         echo $fileLoadWithID[0]['filTag'];
                         ?>
                     </label>
                </div><br>
                <div>
                    <div  class="medium-12 column">
                        <h6 style="color: darkred">
                            Content preview:
                        </h6>
                        <br>
                        <?php

                        $FILE_PATH = '../Files/'.$fileLoadWithID[0]['filPath'];

                        if(pathinfo($FILE_PATH, PATHINFO_EXTENSION) == 'txt' || pathinfo($FILE_PATH, PATHINFO_EXTENSION) == 'rtf' && filesize($FILE_PATH) < 1048576 )
                        {
                            echo $section = file_get_contents('../Files/'.$fileLoadWithID[0]['filPath'], NULL, NULL, 20, 100);
                        }
                        elseif(filesize($FILE_PATH) < 5242880 && (pathinfo($FILE_PATH, PATHINFO_EXTENSION) == 'PNG' || pathinfo($FILE_PATH, PATHINFO_EXTENSION) == 'png' || pathinfo($FILE_PATH, PATHINFO_EXTENSION) == 'bmp' || pathinfo($FILE_PATH, PATHINFO_EXTENSION) == 'jpg'|| pathinfo($FILE_PATH, PATHINFO_EXTENSION) == 'gif'))
                        {
                            ?>
                            <iframe style="width: 400px;height: 300px " src="../Files/<?php echo $fileLoadWithID[0]['filPath'];?>">

                            </iframe>
                            <img src="">
                        <?php
                        }
                        else
                        {
                            echo 'Aucune preview disponible pour ce type de fichier !';
                        }

                        ?>

                    </div>
                </div>
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

                    <?php if($convertedFile<5)
                    {?>
                    <a href="../Files/<?php echo $fileLoadWithID[0]['filPath']?>" class="button" download="<?php $fileLoadWithID[0]['filName'] ?>">Download</a>
                    <?php }else
                    {
                        ?>
                <form action="zipFile.php" method="post">
                        <input type="submit" value="   Zip File " class="button">
                        <input type="hidden" value="../Files/<?php echo $fileLoadWithID[0]['filPath']?>" name="filePath">
                        <input type="hidden" value="<?php echo $fileLoadWithID[0]['filName']?>" name="fileName">

                </form>

                   <?php } ?>


            </div>
            <div class="small-2  ">
                <form action="moveFile.php" method="post">
                    <input type="submit" value="    Move   " class="button">
                    <input type="hidden" value="<?php echo $idFile; ?>" name="id" >
                    <input type="hidden" value="<?php echo $_SESSION['useEmail']?>" name="email">
                </form>
            </div>
            <div class="small-2  " >
                <form action="renameFile.php" method="post">

                    <div class="medium-8 columns" style="padding: 0px">

                        <input  type="hidden" name="filName" id="hybrid" value="<?php for($x=0;$x<count($fileLoadWithID);$x++)
                        {
                            echo $fileLoadWithID[$x]['filName'];
                        }?>">
                    </div>
                    <div class="medium-2">
                        <input id="button" type="button" onclick="  displayHide();changeType()" class="button" value=" Rename ">
                        <div class="hide" id="change">
                            <input type="submit" id="button" class="button" value="  Save  ">
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $idFile ?>" name="idFile">

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
