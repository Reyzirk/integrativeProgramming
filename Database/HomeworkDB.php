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
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Enum/EnumLoad.php';
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
        ->where("HomeworkDesc", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("ClassID", \CustomSQLEnum::BIND_QUESTIONMARK, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
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
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $homework->homeworkID, PDO::PARAM_STR);
        $stmt->bindParam(2, $homework->class, PDO::PARAM_STR);
        $stmt->bindParam(3, $homework->date, PDO::PARAM_STR);
        $stmt->bindParam(4, $homework->homework, PDO::PARAM_STR);
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
                ->where("Date", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $date, PDO::PARAM_STR);
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
                ->where("HomeworkID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
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
                ->where("HomeworkID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function deleteWithClass($id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("homework")
                ->where("ClassID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
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
        $query = $builder->update("homework", array("Date"=>\CustomSQLEnum::BIND_QUESTIONMARK,"HomeworkDesc"=>\CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("HomeworkID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $updated->date, PDO::PARAM_STR);
        $stmt->bindParam(2, $updated->homework, PDO::PARAM_STR);
        $stmt->bindParam(3, $oldID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function access($childID, $id):bool{
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("homework","childclass"), array("*"))
                ->where("homework.ClassID", "childclass.ClassID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("HomeworkID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    
}
