<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mysqlcon
 *
 * @author Dominik
 */
class mysqlcon {
    

    
private static $db;
    private $connection;

    private function __construct() {
        $this->connection = new MySQLi(/* credentials */);
    }

    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new Database();
            
            // database
    db::$config['host'] = 'mysql.hostinger.de';
    db::$config['user'] = 'u659698584_ilyas';
    db::$config['pass'] = 'ilyas1234';
    db::$config['db'] = 'u659698584_kalo';
    // connect
    $this->connection = new mysqli(db::$config['host'], db::$config['user'], db::$config['pass'], db::$config['db']);

            
            
        }
        return self::$db->connection;
    }
}
    

    
   
