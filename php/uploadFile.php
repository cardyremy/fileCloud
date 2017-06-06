<?php

/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    12.05.2017
// But:     Upload de fichiers
//*********************************************************/
//inclusion classe
include_once ('include/dbFunction.inc.php');

//début session
session_start();

//déclaration nouvelle instance
$dbConnect = new dbfunction();

//déclaration variables
$tag = $_POST['tag'];
$name = $_POST['nom'];
$idFolder = $_POST['id'];
$userEmail = $_SESSION['useEmail'];

//appel fonction
$loadUserId= ($dbConnect->selectUserFromSession($userEmail));

$idUser = $loadUserId[0]['idUser'];

//Verification si le fichier est présent
if(!empty($_FILES['file']))
{
    // Constantes
    define('TARGET', '../Files/');    // Repertoire cible
    define('MAX_SIZE', 524288000);                                   // Taille max en octets du fichier
    define('WIDTH_MAX', 2000000000000000);                           // Largeur max de l'image en pixels
    define('HEIGHT_MAX', 2000000000000000);                          // Hauteur max de l'image en pixels

// Tableaux de donnees
    $tabExt = array('jpg','gif','png','jpeg','zip','rar','xlsx','docx','rtf','bmp','png');          // Extensions autorisees
    $infosImg = array();

// Variables
    $extension = '';
    $message = '';
    $nomImage = '';
    $fileName='';

if(!empty($_FILES['file']))
{

//Créer et vérifie le repertoire
    if( !is_dir(TARGET) ) {
        if( !mkdir(TARGET, 0755) ) {
            exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous disposez des droits suffisants pour le faire ou créez le manuellement !');
        }
    }
    /************************************************************
     * Script d'upload
     *************************************************************/

// On verifie si le champ est rempli
    if(!empty($_FILES['file']['name']))
    {
        // Recuperation de l'extension du fichier
        $extension  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // On verifie l'extension du fichier
        //if(in_array(strtolower($extension),$tabExt))
        //{
            // On recupere les dimensions du fichier
            //$infosImg = getimagesize($_FILES['file']['tmp_name']);

            // On verifie le type de l'image

            // On verifie les dimensions et taille de l'image
            //if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['file']['tmp_name']) <= MAX_SIZE))
            //{
                // Parcours du tableau d'erreurs
                if(isset($_FILES['file']['error'])
                    && UPLOAD_ERR_OK === $_FILES['file']['error'])
                {
                    // On renomme le fichier
                    if(empty($name))
                    {

                        $name= pathinfo($_FILES['file']['name'], PATHINFO_FILENAME).'.'.$extension;
                        $fileName = $name.'.'.$extension;


                    }
                    else
                    {
                        $fileName = $name.'.'.$extension;
                        $name = $name.'.'.$extension;
                    }
}


                    // Si c'est OK, on teste l'upload
                    if(move_uploaded_file($_FILES['file']['tmp_name'], TARGET.$fileName))
                    {
                        // echo $message = 'Upload réussi !';
                    }
                    else
                    {
                        // Sinon on affiche une erreur systeme
                        echo $message = 'Problème lors de l\'upload !';
                    }
                }
                else
                {
                    // Sinon on affiche un erreur interne
                    echo $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                }
    /*
            }

            else
            {
                // Sinon erreur sur les dimensions et taille de l'image
                echo $message = 'Erreur dans les dimensions de l\'image !';
            }*/
       /* }
        else
        {
            // Sinon on affiche une erreur pour l'extension
            echo $message = 'L\'extension du fichier est incorrecte !';
        }*/
    }
    else
    {
        // Sinon on affiche une erreur pour le champ vide
        echo $message = 'Veuillez remplir le formulaire svp !';
    }


}
$updateNumber = 1;

$addToDb = $dbConnect->fileUpload($name,$fileName,$tag,$idUser,$idFolder);
$updateFolder = $dbConnect->updateFolderFileCheck($updateNumber = 1,$idFolder);


echo "En cours d'ajout...";
header('Refresh:1 folderPage.php');