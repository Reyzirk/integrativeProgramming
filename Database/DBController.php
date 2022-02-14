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
    
    protected $con;
    protected function connectDB($error = null):boolean{
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
    public function closeDB(){
        $con = null;
    }
}
