<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 15.05.2017
 * Time: 15:39
 */
include_once ('include/dbFunction.inc.php');

$dbConnect = new dbfunction();
$loadFolderNames = $dbConnect->selectAllFromFolder();


$idFolder = $_POST['idFolder'];

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
        <form>
            <label>Folder choose
                <select>
                    <?php for($i=0;$i<count($loadFolderNames);$i++){?> <option value="<?php $loadFolderNames[$i]['idFolder'] ?>"><?php echo $loadFolderNames[$i]['folName'];} ?></option>
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