<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of DBController (Singleton)
 *
 * @author Tang Khai Li & Fong Shu Ling
 * 
 */

class DBController {
    private static $dbConnection = NULL;
    private $con;
    private function __construct(){
        $this->connectionStatus = $this->connectDB();
    }
    private function connectDB($error = null):bool{
        $ini_array = parse_ini_file(str_replace("InstructorArea", "", str_replace("AJAX", "", str_replace("Database", "", dirname(__DIR__)))) ."/config.ini",true);
        $dbSection = $ini_array["Database"];
        $dsn = "mysql:host=".$dbSection["hostname"].";port=".$dbSection["port"].";dbname=".$dbSection["databaseName"]
                .";charset=".$dbSection["charset"];
        $this->con = new PDO($dsn,$dbSection["username"],$dbSection["password"]);
        //Enable exception message
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return true;
    }
    private function closeDB(){
        $this->con = null;
    }
    public static function getInstance(){
        if (self::$dbConnection==NULL){
            self::$dbConnection = new DBController();
        }
        return self::$dbConnection;
    }
    public static function closeConnection(){
        self::$dbConnection = NULL;
    }
    public function __get($name) {
        if (property_exists($this, $name)){
            return $this->$name;
        }else{
            trigger_error("Property $name doesn't exists", E_USER_ERROR);
        }
    }
}
