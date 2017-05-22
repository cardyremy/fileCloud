<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 22.05.2017
 * Time: 08:50
 */
session_start();
session_unset();
session_destroy();

header('Location: index.php');