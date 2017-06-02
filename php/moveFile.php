<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    19.05.2017
// But:     Déplacement de fichier
//*********************************************************/
include_once ('include/dbFunction.inc.php');
$idFile = $_POST['id'];


//déclaration nouvelle instance
$dbConnect = new dbfunction();
//Recupèration donnés sur les dossiers
$loadFolderNames = $dbConnect->selectAllFromFolder();

//Déclaration variable email
$email = $_POST['email'];

//Récuperation informations en fonction du mail
$idUser = $dbConnect->sendRequestUser($email) ;
//Déclaration variable id
$id = $idUser[0]['idUser'];

//Affichage dossier en fonction de l'utilisateur
$loadFolderFromUser = $dbConnect->selectFolderWhereUser($id);


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

        <?php
        include_once('include/header.inc.php');
        ?>

    </head>
    <body>
    <div class="row">
        <div class="medium-12 columns">
            <form action="moveFileRequest.php" method="post">
                <input type="hidden" value="<?php echo $idFile; ?>" name="id">
                <label>Folder choose
                    <select name="destinationFolder">
                        <?php for($i=0;$i<count($loadFolderFromUser);$i++){?> <option value="<?php echo $loadFolderFromUser[$i]['idFolder'] ?>" ><?php echo $loadFolderFromUser[$i]['folName'];}?></option>
                    </select>
                </label>
                <input type="submit" class="button">
            </form>
        </div>

    </div>

    </body>
    </html>

<?php


include_once ('include/footer.inc.php');
