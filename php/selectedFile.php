
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

$inactive = 300;
if( !isset($_SESSION['timeout']) )
    $_SESSION['timeout'] = time() + $inactive;

$session_life = time() - $_SESSION['timeout'];

if($session_life > $inactive)
{  $msg = "Expiration de la session";
    session_destroy(); header('Location:index.php');     }

$_SESSION['timeout']=time();

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


$email = $_SESSION['useEmail'];
$idUser = $dbConnect->sendRequestUser($email) ;

$id= $idUser[0]['idUser'];

$loadFolderFromUser = $dbConnect->selectFolderFromUser($id,$idFromFolder);
$loadFileFromUser = $dbConnect->selectFileFromUser($id,$idFromFolder);


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
            <a href="createFolderForm.php?id=<?php echo $idFromFolder;?>&fk=<?php for($i=0;$i<count($selectFolder);$i++){echo $selectFolder[$i]['fkFolder'];}?>"><img src="../img/addFold2.png" style="height: 45px;width: 45px"></a>
            <!--<a href="#"><img src="../img/edit.ico" style="height: 45px;width: 45px"></a> -->
            <a onclick=" return deleteConf('<?php if (isset($_GET['id'])) { echo $selectFolder[0]['folName']; }?>');" href="deleteFolder.php?id=<?php echo $idFromFolder;?>"><img src="../img/delete.ico" style="height: 45px;width: 45px"></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="medium-4 columns " style="padding: 0px">
        <div id="titleHide" class="row">
            <h5 class="medium-6 columns" ><?php

                for($x=0;$x<count($selectFolder);$x++)
                {
                    echo $name= $selectFolder[$x]['folName'];

                }

                ?></h5>
        </div>

        <div class="row ">
            <form action="renameFolder.php" method="post">
                <div class="medium-10 columns" style="padding-right: 0px">
                    <input  type="hidden" name="folName" id="hybrid" value="<?php for($x=0;$x<count($selectFolder);$x++)
                    {
                        echo $selectFolder[$x]['folName'];
                    }?>">

                </div>
                <div class="medium-10" style="padding-left: 15px">
                    <input id="button" type="button" onclick=" displayHide();changeType()" class="button" value="Rename">
                    <div class="hide" id="change">
                        <input type="submit" id="button" class="button" value="Save" style="padding-right: 20px">
                    </div>
                </div>
                <input type="hidden" name="idFolder" value="<?php echo $idFromFolder; ?>">
            </form>
            <form method="post" action="moveFolder.php" style="padding-left: 15px">
                <input type="hidden" value="<?php echo $idFromFolder ?>" name="idFolder">
                <input type="hidden" value="<?php echo $email ?>" name="email">
                <div class="medium-6 ">
                    <input type="submit" class="button" value="  Move   ">
                </div>

            </form>

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
                    for($i=0;$i<count($loadFolderFromUser);$i++)
                    {
                        ?>
                        <img src="../img/folderClose.png" style="height: 25px;width: 25px">
                        <a href="selectedFile.php?id=<?php echo $loadFolderFromUser[$i]['idFolder']; ?>"><?php echo $loadFolderFromUser[$i]['folName']; ?></a><br>

                        <?php
                    }
                    for($j=0;$j<count($loadFileFromUser);$j++){
                        ?>

                            <a href="fileDetails.php?id=<?php echo $loadFileFromUser[$j]['idFile'];?>"> <?php echo $loadFileFromUser[$j]['filName'];?></a>
                            <br>




                    <?php } ?>

                    <form action="test.php" onclick=" return change<?php echo $j?>()">
                        <input type="hidden" id="renameButton<?php echo $j ?>"  value=" Rename " class="button" >

                    </form>
                    <form onclick="change<?php echo $j?>()">
                        <input type="hidden" id="moveButton<?php echo $j ?>"  value="    Move   " class="button">
                    </form>


                    <form  onclick="change<?php echo $j?>()">
                        <input type="hidden" id="download<?php echo $j ?>"  value="Download" class="button">
                    </form>

                    <form  onclick="change<?php echo $j?>()">
                        <input type="hidden" id="infos<?php echo $j ?>"  value="  Details   " class="button">
                    </form>

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



    <div class="medium-8 columns"style="padding: 0px">
        <label>
            <h4>Upload files</h4>
        </label>

        <form action="uploadFile.php" method="post" enctype="multipart/form-data">
            <label>
                Nom du fichier
            </label>
            <input type="text" name="nom" placeholder="Name" required>
            <input type="text" name="tag" placeholder="Tag" required>
            <input type="hidden" value="<?php echo $idFromFolder; ?>" name="id">
            <label>
                Maximum 500Mo
            </label>
            <input type="file" id="fileUpload" name="file">
            <input type="hidden" name="MAX_FILE_SIZE" value="500000000">
            <input type="submit" value="submit" class="button">
        </form>
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
