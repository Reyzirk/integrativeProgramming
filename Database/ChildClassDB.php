<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of ChildClassDB
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Homework.php';
class ChildClassDB {
    private $instance;
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    public function getCount($search,$id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("childclass","child","parent"), array("ParentEmail","ChildName","ChildICNo"))
        ->where("ParentEmail", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ChildName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ChildICNo", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("childclass.ChildID", "child.ChildID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
        ->where("child.ParentID", "parent.ParentID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("childclass.ClassID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->bracketWhere(WhereTypeEnum::AND)
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
    public function insert($childclass){
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("childclass")
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $classID = $childclass->classID;
        $childID = $childclass->childID;
        $priority = $childclass->priority;
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $classID, PDO::PARAM_STR);
        
        $stmt->bindParam(3, $priority, PDO::PARAM_INT);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function delete($childclass){
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("childclass")
                ->where("ClassID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $classID = $childclass->classID;
        $childID = $childclass->childID;
        $stmt->bindParam(1, $classID, PDO::PARAM_STR);
        $stmt->bindParam(2, $childID, PDO::PARAM_STR);
        
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function list($id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("childclass"), array("*"))
                ->where("ClassID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return array();
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
    }
    public function validID($childclass): bool{
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("childclass"), array("*"))
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("ClassID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $classID = $childclass->classID;
        $childID = $childclass->childID;
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $classID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function getPriority($childclass):int{
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("childclass"), array("*"))
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("ClassID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->order("Priority")
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $classID = $childclass->classID;
        $childID = $childclass->childID;
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $classID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return 0;
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            return $row["Priority"];
        }
    }
}
