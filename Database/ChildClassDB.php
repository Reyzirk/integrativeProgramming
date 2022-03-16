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
        ->where("ChildICNo", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::EQUAL)
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
    public function insert($homework){
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("homework")
                ->values(array($homework->homeworkID,$homework->class,$homework->date,$homework->homework))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function dateExist($date){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("homework"), array("*"))
                ->where("Date", $date)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function details($id){
         $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("homework"), array("*"))
                ->where("HomeworkID", $id)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return NULL;
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            $result = new Homework($row["HomeworkID"],$row["ClassID"],$row["Date"],$row["HomeworkDesc"]);
            $resultList = $result;
            return $resultList;
        }
    }
    public function delete($id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("homework")
                ->where("HomeworkID", $id)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function update($oldID, $updated){
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("homework", array("Date"=>$updated->date,"HomeworkDesc"=>$updated->homework))
                ->where("HomeworkID", $oldID)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
}
