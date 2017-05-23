<?php

session_start();





header('Refresh:0 index.php');

$time_start = microtime();
//5Sec
sleep(50);
$time_end = microtime();
$time = $time_end - $time_start;


if($time < 1)
{
    unset($_SESSION['useEmail']);
}
