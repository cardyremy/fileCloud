<?php
/**********************************************************
// Societe: ETML
// Auteur:  Cardy Remy
// Date:    11.05.2017
// But: Footer du site
//*********************************************************/


header('Content-Type: text/html; charset=utf-8');

class dbfunction
{
// constantes pour la BD
    const STR_DB_NAME = "db_filecloud";//"filecloud_inf_etmlnet_local";

    /*********************************************
     * Nom : __construct
     * But: il s'agit du constructeur
     * Retour:
     * Paramètre:
     * *******************************************/
    public function __construct()
    {
        $this->dbConnection();
    }
    /*********************************************
     * Nom : __destruct
     * But: il s'agit du destructeur
     * Retour:
     * Paramètre:
     * *******************************************/
    public function __destruct()
    {
        $this->dbDeconnection();
    }
    /*********************************************
     * Nom : dbConnection
     * But: Etablie la connection à la base de donnée
     * Retour:
     * Paramètre:
     * *******************************************/
    private function dbConnection()
    {
        // Connection à la db
        try {
            $this->objectConnection = new PDO('mysql:host=localhost;dbname=' . self::STR_DB_NAME . ';charset=utf8', 'root', '');
        } //Affiche les eventuelles erreures si la connection echoue
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /*Fonction de déconnection de la base de données*/
    private function dbDeconnection()
    {
        $this->objectConnection = null;
    }

    /*********************************************
     * Nom : selectAllUser
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function selectAllUser()
    {
        $strSQLRequestUser = "select * from t_user";
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute();
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom : selectAllFromFolder
     * But: Afficher les informations de la table t_folder
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function selectAllFromFolder()
    {
        $strSQLRequestUser = "select * from t_folder" ;
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute();
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom : selectAllFromFfile
     * But: Afficher les informations de la table file en fonction du fk
     * Retour: $getAll
     * Paramètre: $id
     * *******************************************/

    public function selectAllFromFfile($id)
    {
        $strSQLRequestUser = "select * from t_file WHERE fkFolder=?";
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($id));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :insertFolder
     * But: Ajouter à la base de donnée le champ nom depuis un parametre
     * Retour:$getAll
     * Paramètre: $folName,$fkFolder
     * *******************************************/
    public function insertFolder($folName,$fkFolder,$fkUser)
    {

        $strSignUpSQL = "INSERT INTO t_folder (folName,fkFolder,fkUser) VALUES (?,?,?)";
        $query = $this->objectConnection->prepare($strSignUpSQL);
        $rsResult = $query->execute(array($folName,$fkFolder,$fkUser));
        $getAll = $query->fetchAll();
        $query->closeCursor();
        return $getAll;

    }
    /*********************************************
     * Nom :deleteFolder
     * But: Supprime le contenu de la table t_article en fonction du artBlock et du fkMenu
     * Retour:$isExecuted
     * Paramètre:$idFolder
     * *******************************************/
    public function deleteFolder($idFolder)
    {
        $strSQLDrop = "DELETE FROM t_folder WHERE idFolder=?";
        $query = $this->objectConnection->prepare($strSQLDrop);
        $isExecuted = $query->execute(array($idFolder));
        $query->closeCursor();

        return $isExecuted;
    }

    /*********************************************
     * Nom : selectFolder
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function selectFolder($id)
    {
        $strSQLRequestUser = "select * from t_folder WHERE idFolder=?" ;
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($id));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :updateFolder
     * But: Mettre à jour le champ nom du t_folder
     * Retour:$isExecuted
     * Paramètre:$folderName, $idFolder
     * *******************************************/
    public function updateFolder ($folderName, $idFolder)
    {
        $strUpdateSQL = "UPDATE t_folder SET folName = ? WHERE idFolder =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($folderName, $idFolder));
        $query->closeCursor();
        return $isExecuted;
    }

    /*********************************************
     * Nom :
     * But:
     * Retour:$getAll
     * Paramètre: $folName,$fkFolder
     * *******************************************/
    public function moveFolder($folName,$fkFolder,$idFolder)
    {

        $strUpdateSQL = "UPDATE t_folder SET folName=?, fkFolder=? WHERE idFolder =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($folName,$fkFolder,$idFolder));
        $query->closeCursor();
        return $isExecuted;

    }

    /*********************************************
     * Nom :
     * But:
     * Retour:$getAll
     * Paramètre:
     * *******************************************/
    public function moveFile($firstFkFile,$secondFkFIle)
    {



        $strUpdateSQL = "UPDATE t_file SET fkFolder=? WHERE fkFolder =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($firstFkFile,$secondFkFIle));
        $query->closeCursor();
        return $isExecuted;

    }

    /*********************************************
     * Nom :updateFile
     * But:
     * Retour:$isExecuted
     * Paramètre:$folderName, $idFolder
     * *******************************************/
    public function updateFile ($fileName,$idFile)
    {
        $strUpdateSQL = "UPDATE t_file SET filName = ? WHERE idFile =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($fileName,$idFile));
        $query->closeCursor($fileName,$idFile);
        return $isExecuted;
    }


    /*********************************************
     * Nom : selectFolderFK
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function selectFolderFK($id)
    {
        $strSQLRequestUser = "select * from t_folder WHERE fkFolder=?" ;
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($id));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :
     * But:
     * Retour:$getAll
     * Paramètre: $folName,$fkFolder
     * *******************************************/
    public function fileUpload($fileName,$filePath,$filTag,$fkUser,$fkFolder)
    {

        $strSignUpSQL = "INSERT INTO t_file (filName,filPath,filTag,fkUser,fkFolder) VALUES (?,?,?,?,?)";
        $query = $this->objectConnection->prepare($strSignUpSQL);
        $rsResult = $query->execute(array($fileName,$filePath,$filTag,$fkUser,$fkFolder));
        $getAll = $query->fetchAll();
        $query->closeCursor();
        return $getAll;

    }
    /*********************************************
     * Nom :updateFolderFileCheck
     * But:
     * Retour:$isExecuted
     * Paramètre:$folFileUpdate, $idFolder
     * *******************************************/
    public function updateFolderFileCheck ($folFileUpdate, $idFolder)
    {
        $strUpdateSQL = "UPDATE t_folder SET folFileCheck = ? WHERE idFolder =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($folFileUpdate, $idFolder));
        $query->closeCursor();
        return $isExecuted;
    }


    /*********************************************
     * Nom :
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function selectFileID($id)
    {
        $strSQLRequestUser = "select * from t_file WHERE idFile=?" ;
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($id));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :
     * But:
     * Retour:$isExecuted
     * Paramètre:$folFileUpdate, $idFolder
     * ******************************************/
    public function updateFileMove ($fkFolder, $idFile)
    {
        $strUpdateSQL = "UPDATE t_file SET fkFolder = ? WHERE idFile =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($fkFolder, $idFile));
        $query->closeCursor();
        return $isExecuted;
    }

    /*********************************************
     * Nom :
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function fileCheckMoreThanOne($id)
    {
        $strSQLRequestUser = "select fkFolder from t_file WHERE idFile=?" ;
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($id));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :
     * But:
     * Retour:$isExecuted
     * Paramètre:$idFolder
     * *******************************************/
    public function deleteFile($idFile)
    {
        $strSQLDrop = "DELETE FROM t_file WHERE idFile=?";
        $query = $this->objectConnection->prepare($strSQLDrop);
        $isExecuted = $query->execute(array($idFile));
        $query->closeCursor();

        return $isExecuted;
    }

    /*********************************************
     * Nom : sendRequestUser
     * But: Afficher toutes les information de l'utilisateur qui est en parametre
     * Retour:$getAll
     * Paramètre:$username
     * *******************************************/
    public function sendRequestUser($userEmail=null)
    {
        $strSQLRequestUser = "select * from t_user  WHERE useEmail=?";
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($userEmail));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :usernameCheck
     * But:Verifier que l'utilisateur existe dans la BD
     * Retour:$getAll
     * Paramètre:$usernameCheck
     * *******************************************/
    public function usernameCheck ($userEmailCheck)
    {
        $strSelectUserSQL = "SELECT useEmail FROM t_user WHERE useEmail = ?";
        $query = $this-> objectConnection->prepare($strSelectUserSQL);

        $rsResult = $query->execute(array($userEmailCheck));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function selectFolderFromUser($userId,$fkFolder)
    {
        $strSQLRequestUser = "SELECT * FROM t_folder WHERE fkUser =? AND fkFolder = ? AND folDeleted =0";
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($userId,$fkFolder));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }
    /*********************************************
     * Nom :
     * But:Verifier que l'utilisateur existe dans la BD
     * Retour:$getAll
     * Paramètre:$usernameCheck
     * *******************************************/
    public function selectUserFromSession ($userEmail)
    {
        $strSelectUserSQL = "SELECT idUser FROM t_user WHERE useEmail = ?";
        $query = $this-> objectConnection->prepare($strSelectUserSQL);

        $rsResult = $query->execute(array($userEmail));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function selectFileFromUser($userId,$fkFolder)
    {
        $strSQLRequestUser = "SELECT * FROM t_file WHERE fkUser =? AND fkFolder = ?";
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($userId,$fkFolder));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :emailCheckUser
     * But:Verifier que l'email existe dans la BD
     * Retour:$getAll
     * Paramètre:$useEmail
     * *******************************************/
    public function emailCheckUser ($useEmail)
    {
        $strSelectUserSQL = "SELECT useEmail FROM t_user WHERE useEmail = ?";
        $query = $this-> objectConnection->prepare($strSelectUserSQL);

        $rsResult = $query->execute(array($useEmail));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }


    /*********************************************
     * Nom :updateConfirmKey
     * But:Mettre à jour la valeur de confirmation de l'utilisateur
     * Retour:$isExecuted
     * Paramètre:
     * *******************************************/
    public function updateConfirmKey ($useEmail)
    {
        $strUpdateSQL = "UPDATE t_user SET useConfirm = '1' WHERE useEmail =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($useEmail));
        $query->closeCursor();
        return $isExecuted;
    }
    /*********************************************
     * Nom :
     * But:
     * Retour:$isExecuted
     * Paramètre:
     * *******************************************/

    public function newUser($userName,$userEmail,$userPwd,$userToken)
    {

        $strSignUpSQL = "INSERT INTO t_user (useName,useEmail,usePassword,useToken) VALUES (?,?,?,?)";
        $query = $this->objectConnection->prepare($strSignUpSQL);
        $rsResult = $query->execute(array($userName,$userEmail,$userPwd,$userToken));
        $getAll = $query->fetchAll();
        $query->closeCursor();
        return $getAll;

    }



    /*********************************************
     * Nom :emailCheckUser
     * But:Verifier que l'email existe dans la BD
     * Retour:$getAll
     * Paramètre:$useEmail
     * *******************************************/
    public function tokenCheck ($useEmail)
    {
        $strSelectUserSQL = "SELECT * FROM t_user WHERE useEmail = ?";
        $query = $this-> objectConnection->prepare($strSelectUserSQL);

        $rsResult = $query->execute(array($useEmail));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }
    /*********************************************
 * Nom : sendRequestTag
 * But:
 * Retour: $getAll
 * Paramètre: --
 * *******************************************/
    public function sendRequestTag($tag,$fkUSer)
    {
        $strSQLRequestUser = "select * from t_file WHERE filTag like '%$tag%' OR filName like '%$tag%' AND fkUser ='$fkUSer'";
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute();
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom : sendRequestTag
     * But:
     * Retour: $getAll
     * Paramètre: --
     * *******************************************/
    public function sendRequestTagFolder($tag,$fkUSer)
    {
        $strSQLRequestUser = "select * from t_folder WHERE folName like '%$tag%' AND fkUser ='$fkUSer'";
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute();
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :updateConfirmKey
     * But:Mettre à jour la valeur de confirmation de l'utilisateur
     * Retour:$isExecuted
     * Paramètre:
     * *******************************************/
    public function updateUserPassword ($usePassword,$useEmail)
    {
        $strUpdateSQL = "UPDATE t_user SET usePassword = ? WHERE useEmail =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($usePassword,$useEmail));
        $query->closeCursor();
        return $isExecuted;
    }

    /*********************************************
     * Nom :
     * But:
     * Retour:$isExecuted
     * Paramètre:
     * *******************************************/
    public function updateUserLoginAttemps ($loginAtemps, $useEmail)
    {
        $strUpdateSQL = "UPDATE t_user SET useLoginAttemp = ? WHERE useEmail =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($loginAtemps, $useEmail));
        $query->closeCursor();
        return $isExecuted;
    }
    /*********************************************
     * Nom :
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function selectFolderWhereUser($userId)
    {
        $strSQLRequestUser = "SELECT * FROM t_folder WHERE fkUser =?";
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($userId));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }
    /*********************************************
     * Nom :
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function selectFolderWhereUserAndFK($userId,$fkFolder)
    {
        $strSQLRequestUser = "SELECT * FROM t_folder WHERE fkUser =? AND idFolder !=? AND folDeleted = 0";
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute(array($userId,$fkFolder));
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :updateConfirmKey
     * But:Mettre à jour la valeur de confirmation de l'utilisateur
     * Retour:$isExecuted
     * Paramètre:
     * *******************************************/
    public function updateFlagDeleted ($folDate,$fk)
    {
        $strUpdateSQL = "UPDATE t_folder SET folDeleted = 1,folDate=? WHERE idFolder =?";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute(array($folDate,$fk));
        $query->closeCursor();
        return $isExecuted;
    }

    /*********************************************
     * Nom : selectAllFromFolder
     * But: Afficher les informations de la table t_folder
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function checkDeletedFlagOnFolder()
    {
        $strSQLRequestUser = "select folDeleted from t_folder WHERE folDeleted=1" ;
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute();
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }

    /*********************************************
     * Nom :deleteFolderPermanently
     * But: Supprime le contenu de la table t_article en fonction du artBlock et du fkMenu
     * Retour:$isExecuted
     * Paramètre:$idFolder
     * *******************************************/
    public function deleteFolderPermanently()
    {
        $strSQLDrop = "DELETE FROM t_folder WHERE folDeleted=1";
        $query = $this->objectConnection->prepare($strSQLDrop);
        $isExecuted = $query->execute();
        $query->closeCursor();

        return $isExecuted;
    }
    /*********************************************
     * Nom :updateConfirmKey
     * But:Mettre à jour la valeur de confirmation de l'utilisateur
     * Retour:$isExecuted
     * Paramètre:
     * *******************************************/
    public function updateFlagRestore ()
    {
        $strUpdateSQL = "UPDATE t_folder SET folDeleted = 0 WHERE folDeleted =1";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute();
        $query->closeCursor();
        return $isExecuted;
    }
    /*********************************************
     * Nom : selectAllFromFolder
     * But: Afficher les informations de la table t_folder
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function checkDeletedFlagOnFile()
    {
        $strSQLRequestUser = "select filDeleted from t_file WHERE filDeleted=1" ;
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute();
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;

    }

    /*********************************************
     * Nom :updateConfirmKey
     * But:Mettre à jour la valeur de confirmation de l'utilisateur
     * Retour:$isExecuted
     * Paramètre:
     * *******************************************/
    public function updateFlagFile ()
    {
        $strUpdateSQL = "UPDATE t_file SET filDeleted = 1 WHERE filDeleted =0";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute();
        $query->closeCursor();
        return $isExecuted;
    }
    /*********************************************
     * Nom :deleteFolderPermanently
     * But: Supprime le contenu de la table t_article en fonction du artBlock et du fkMenu
     * Retour:$isExecuted
     * Paramètre:$idFolder
     * *******************************************/
    public function deleteFilePermanently()
    {
        $strSQLDrop = "DELETE FROM t_file WHERE filDeleted=1";
        $query = $this->objectConnection->prepare($strSQLDrop);
        $isExecuted = $query->execute();
        $query->closeCursor();

        return $isExecuted;
    }
    /*********************************************
     * Nom :updateConfirmKey
     * But:Mettre à jour la valeur de confirmation de l'utilisateur
     * Retour:$isExecuted
     * Paramètre:
     * *******************************************/
    public function updateFlagRestoreFile()
    {
        $strUpdateSQL = "UPDATE t_file SET filDeleted = 0 WHERE filDeleted =1";
        $query = $this->objectConnection->prepare($strUpdateSQL);
        $isExecuted = $query->execute();
        $query->closeCursor();
        return $isExecuted;
    }
    /*********************************************
     * Nom : selectAllFromFolder
     * But: Afficher les informations de la table t_folder
     * Retour: $getAll
     * Paramètre: -
     * *******************************************/

    public function checkDateOnFolder()
    {
        $strSQLRequestUser = "select folDate from t_folder WHERE folDeleted=1" ;
        $query = $this->objectConnection->prepare($strSQLRequestUser);
        $rsResult = $query->execute();
        $getAll = $query->fetchAll();
        $query->closeCursor();

        return $getAll;
    }



}