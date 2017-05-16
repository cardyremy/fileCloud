<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    12.05.2017
// But:
//*********************************************************/

include_once ('include/header.inc.php');

$idFolder = $_GET['id'];
$fkFolder = $_GET['fk'];

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

<div class="row">
    <div class="medium-6 columns" style="padding: 0px">
        <form action="addFolderDB.php" method="post">
            <label>
                Folder Name
                (Max legth 30)
            </label>
            <input type="text" placeholder="Folder Name" name="folName" maxlength="30">
            <input type="hidden" value="<?php echo $idFolder; ?>" name="idFolder">
            <input type="submit" class="button" class="button">

        </form>
    </div>
</div>




</body>

</html>








<?php

include_once ('include/footer.inc.php');

?>
