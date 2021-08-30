<?php
/*
* Mysql database class - only one connection alowed
*/
class Database {
    private $_connection;
    private static $_instance; //The single instance
    /*
    Get an instance of the Database
    @return Instance
    */
    
    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // Constructor
    public function __construct() {
        $_config = parse_ini_file(ROOT . '../private/config.ini');

        $this->_connection = new mysqli($_config['servername'], $_config['username'], 
            $_config['password'], $_config['dbname']);
    
        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                 E_USER_ERROR);
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
    // Get mysqli connection
    public function getConnection() {
        return $this->_connection;
    }
}
?>