<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of resetPasswordDB
 *
 * @author Shu Ling
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';

class resetPasswordDB{
    private $instance;
    
    public function __construct() {
        $this ->instance = DBController::getInstance();
    }
    
    public function insert($email, $code, $type)
    {
        $builder = new MySQLQueryBuilder();
        $query = "INSERT INTO resetpassword (email, code, type) VALUES(?,?,?)";
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $code, PDO::PARAM_STR);
        $stmt->bindParam(3, $type, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if($totalrows == 0)
        {
            return false;
        }else
        {
            return true;
        }
    }
    
    public function delete($email){
        $query = "DELETE FROM resetpassword WHERE email=?";
        $stmt = $this->instance->con->prepare($query);
        
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if($totalrows == 0)
        {
            return false;
        }else
        {
            return true;
        }
    }
    
    public function exists($email,$code){
        $query = "SELECT * FROM resetpassword WHERE email=? AND code = ?";
        $stmt = $this->instance->con->prepare($query);
        
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $code, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if($totalrows == 0)
        {
            return false;
        }else
        {
            return true;
        }
    }
}