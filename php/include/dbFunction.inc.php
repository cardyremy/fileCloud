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
    const STR_DB_NAME = "db_filecloud";

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
     * Nom : sendRequestUser
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
     * Nom : sendRequestUser
     * But: Afficher les informations de la table t_user
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
     * Nom : sendRequestUser
     * But: Afficher les informations de la table t_user
     * Retour: $getAll
     * Paramètre: -
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

























}