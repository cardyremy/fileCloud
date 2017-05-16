<?php
/**
 * Created by PhpStorm.
 * User: Cardyre
 * Date: 12.05.2017
 * Time: 09:33
 */

include_once ('include/dbFunction.inc.php');

$tag = $_POST['tag'];
$name = $_POST['nom'];
$idFolder = $_POST['id'];
$userId = 1;

$dbConnect = new dbfunction();

if(!empty($_FILES['file']))
{
    // Constantes
    define('TARGET', '../Files/');    // Repertoire cible
    define('MAX_SIZE', 100000000000);                         // Taille max en octets du fichier
    define('WIDTH_MAX', 200000000);                           // Largeur max de l'image en pixels
    define('HEIGHT_MAX', 200000000);                          // Hauteur max de l'image en pixels

// Tableaux de donnees
    $tabExt = array('jpg','gif','png','jpeg');          // Extensions autorisees
    $infosImg = array();

// Variables
    $extension = '';
    $message = '';
    $nomImage = '';

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
        if(in_array(strtolower($extension),$tabExt))
        {
            // On recupere les dimensions du fichier
            $infosImg = getimagesize($_FILES['file']['tmp_name']);

            // On verifie le type de l'image

            // On verifie les dimensions et taille de l'image
            if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['file']['tmp_name']) <= MAX_SIZE))
            {
                // Parcours du tableau d'erreurs
                if(isset($_FILES['file']['error'])
                    && UPLOAD_ERR_OK === $_FILES['file']['error'])
                {
                    // On renomme le fichier
                    $fileName = $name.'.'.$extension;

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
            }
            else
            {
                // Sinon erreur sur les dimensions et taille de l'image
                echo $message = 'Erreur dans les dimensions de l\'image !';
            }
        }
        else
        {
            // Sinon on affiche une erreur pour l'extension
            echo $message = 'L\'extension du fichier est incorrecte !';
        }
    }
    else
    {
        // Sinon on affiche une erreur pour le champ vide
        echo $message = 'Veuillez remplir le formulaire svp !';
    }


}
}

$addToDb = $dbConnect->fileUpload($name,$fileName,$tag,$userId,$idFolder);

echo "En cours d'ajout...";
header('Refresh:1 folderPage.php');