<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    22.05.2017
// But:  destruction de la session
//*********************************************************/

session_start();
session_unset();
session_destroy();

header('Location: index.php');