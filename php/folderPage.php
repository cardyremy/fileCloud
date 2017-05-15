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
            <a href="createFolderForm.php?fk=<?php echo $idFromFolder;?>"><img src="../img/addFold2.png" style="height: 45px;width: 45px"></a>
            <a href="#"><img src="../img/edit.ico" style="height: 45px;width: 45px"></a>
            <a onclick=" return deleteConf('<?php if (isset($_GET['id'])) { echo $loadFolderData[0]['folName']; }?>');" href="deleteFolder.php?id=<?php echo $idFromFolder;?>"><img src="../img/delete.ico" style="height: 45px;width: 45px"></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="medium-6 columns " style="padding: 0px">
        <div id="myDIV" class="row">
            <h5 class="medium-6 columns medium-centered" style="padding:0px"><?php

                for($x=0;$x<count($selectFolder);$x++)
                {
                    echo $selectFolder[$x]['folName'];

                }

                ?></h5>
        </div>

        <div class="row ">
            <form action="renameFolder.php" method="post">
                <div class="medium-6 columns medium-centered"  style="padding:0px" >
                    <input type="hidden" name="folName" id="hybrid" value="<?php for($x=0;$x<count($selectFolder);$x++)
                    {
                        echo $selectFolder[$x]['folName'];
                    }?>">

                </div>
                <div class="medium-6 medium-centered">
                    <input type="button" onclick="changeType();myFunction()" class="button" value="Rename">
                    <div class="hide" id="change">
                        <input type="submit" id="button" class="button" value="Save">
                    </div>
                </div>
                <input type="hidden" name="idFolder" value="<?php echo $idFromFolder; ?>">

            </form>
            <form method="post" action="moveFolder.php">
                <div class="medium-6 medium-centered">
                    <input type="submit" class="button" value="  Move   ">
                </div>

            </form>

        </div>
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
            <input type="submit" value="submit" class="button">
        </form>
    </div>
</div>

<div class="space">

</div>
</body>
</html>


<script>
    function myFunction() {
        var x = document.getElementById('myDIV');
        if (x.style.display === 'none') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
    }

    function changeType()
    {
            if(document.getElementById('hybrid').type == 'hidden')
            {
                document.getElementById('hybrid').type = 'text';
                document.getElementById("change").className = "medium-3 columns";
            }
        else
            {
                document.getElementById('hybrid').type = 'hidden';
                document.getElementById("change").className = "hide";

            }
    }
</script>


<?php

include_once ('include/footer.inc.php');


?>
