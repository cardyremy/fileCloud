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
$flag = $dbConnect->checkDeletedFlagOnFolder();
$flagFile = $dbConnect->checkDeletedFlagOnFile();
$dateDb = $dbConnect->checkDateOnFolder();

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
            <?php
            if(!empty($flag))
            {
                $date = new DateTime();
                $today= $date->format('U') . "\n";

            if ($today - $dateDb[0]['folDate'] < 30) {

                ?>
                <form action="restoreFlagFolder.php">
                    <input type="submit" class="button" value=" Restore your files   " id="restore">
                </form>

                <form action="deletePermanentFolder.php">
                    <input type="submit" class="button" value="Delete Permanently" id="cancel">
                </form>

            <?php

            }
            else {
                header('Location: deletePermanentFolder.php');
            }

                ?>
                <script>

                    //setTimeout(mafonction, 5000);
                    setTimeout(function () {
                        document.getElementById('restore').type = 'hidden';
                        document.getElementById('cancel').type = 'hidden';
                        location.href = 'deletePermanentFolder.php';

                    }, 30000);




                </script>


            <?php


            }
            elseif(!empty($flagFile))
            {
            ?>



                <form action="restoreFlagFile.php">
                    <input type="submit" class="button" value=" Restore your files   " id="restoreFile">
                </form>

                <form action="deletePermanentFile.php">
                    <input type="submit" class="button" value="Delete Permanently" id="cancelFile">
                </form>
                <script>

                    //setTimeout(mafonction, 5000);
                    setTimeout(function ()
                    {
                        document.getElementById('restoreFile').type = 'hidden';
                        document.getElementById('cancelFile').type = 'hidden';
                        location.href = 'deletePermanentFile.php';

                    },30000);


                </script>


                <?php

            }

            ?>

        </div>

    </div>
</div>

<div class="row">
    <div class="medium-6 columns " style="padding: 0px">


        <div class="row ">


        </div>
        <img src="../img/folderClose.png">
    </div>
    <div class="medium-6 columns " >
            <div class="row">
                <div class="white"style="padding-left: 20px">
                    <div class="medium-4  ">
                        <p>Name</p>
                    </div>

                        <?php
                        for($i=0;$i<count($loadFolderData);$i++)
                        {

                        if($loadFolderData[$i]['fkFolder']== NULL){?><img src="../img/folderClose.png" style="height: 25px;width: 25px">
                            <a href="selectedFile.php?id=<?php echo $loadFolderData[$i]['idFolder']; ?>"><?php  echo $loadFolderData[$i]['folName'];?></a><br> <?php } else{echo '';} ?>

                        <?php
                        }
                            ?>


                    </div>

                </div>
            </div>
    </div>
</div>


<div class="space">

</div>
</body>
</html>

<script src="../js/renameHide.js"></script>

<script>
   /* function changeButton()
    {
            document.getElementById('button').type = 'button';
            document.getElementById("change").className = "medium-3 columns";
        return changeButton();
    }

*/
</script>

<?php

include_once ('include/footer.inc.php');


?>
