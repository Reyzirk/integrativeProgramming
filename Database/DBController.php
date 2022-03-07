<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of DBController
 *
 * @author Choo Meng
 */

namespace Database;

use PDO;

class DBController {
    private static $dbConnection = NULL;
    private $con;
    private function __construct(){
        
    }
    private function connectDB($error = null):boolean{
        try{
            $ini_array = parse_ini_file(dirname(__DIR__)."config.ini",true);
            $dbSection = $ini_array["Database"];
            $dsn = "mysql:host=".$dbSection["hostname"].";port=".$dbSection["port"].";dbname=".$dbSection["databaseName"]
                    .";charset=".$dbSection["charset"];
            $con = new PDO($dsn,$dbSection["username"],$dbSection["password"]);
            //Enable exception message
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $ex) {
            $error = $ex->getMessage();
            return false;
        }
    }
    private function closeDB(){
        $con = null;
    }
    public static function getInstance(){
        if (self::$dbConnection==NULL){
            self::$dbConnection = new DBController();
        }
        return self::$dbConnection;
    }
    public static function closeConnection(){
        self::$dbConnection.$this->closeDB();
        self::$dbConnection = NULL;
    }
}
