<?php
require_once(dirname(__FILE__)."/../includes/config.php");

/**
 * Connect database and select out all client data.
 * @author Jun Zhang
 */
class AdminModel {
    
    // mysql username
    private static $USER_NAME = DB_USER;
    // mysql password
    private static $PASSWORD = DB_PASS;    
    // mysql host name
    private static $HOST_NAME = DB_SERVER;
    // DB name
    private static $DB_NAME = DB_NAME;   
    // PDO object
    public $mDBH;
    
    
    /** 
     * Ctor
     * Create database handler obj
     */
    public function __construct() {
        try {
            $this->mDBH = new PDO("mysql:host=".self::$HOST_NAME.
                ";dbname=".self::$DB_NAME, 
                self::$USER_NAME, self::$PASSWORD);
            // set the error reporting attribute
            $this->mDBH->setAttribute(PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION); 
        }
        // Close the database connection
        catch(PDOException $e) {
            echo "Exception caught when creating PDO object --- ", 
                $e->getMessage(), "\n";
            die;
        }       
    }
    
    /** 
     * Dtor
     * GC database handler obj
     */
    public function __destruct() {
        // GC dbh
        $this->mDBH = null;
    }  
        
    /**
     * Fetch all data stored in db
     * @param string $tableName: name of the table
     */
    public function getAllData($tableName) {
        $sql = "SELECT * FROM $tableName ORDER BY slotNumber";
        try{
            $sth = $this->mDBH->prepare($sql);
            $sth->execute();
            $results = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Exception caught when calling getAllData() --- ", 
                $e->getMessage(), "\n";
            die;
        }
        return $results;
    }
}

?>
