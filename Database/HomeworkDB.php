<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of HomeworkDB
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Homework.php';
class HomeworkDB {
    private $instance;
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    public function getCount($search,$id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("homework"), array("*"))
        ->where("HomeworkID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Date", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("HomeworkDesc", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::EQUAL)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("ClassID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        return $totalrows;
    }
    public function select($query){
        
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return NULL;
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
    }
}
