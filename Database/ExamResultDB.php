<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of ExamResultDB
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/ExamResult.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Examination.php';
class ExamResultDB {
    private $instance;
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    public function getCount($search,$id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("examresults","child","examination","parent"), array("ChildName","ParentEmail","examresults.Marks","child.ChildID"))
        ->where("ParentEmail", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ChildName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("examresults.Marks", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("child.ChildID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("examresults.ExaminationID", "examination.ExaminationID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
        ->where("examresults.ChildID", "child.ChildID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("child.ParentID", "parent.ParentID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("examresults.ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->bracketWhere(WhereTypeEnum::AND)
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
    public function insert($examresult){
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("examresults")
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $examID = $examresult->examinationID;
        $childID = $examresult->childID;
        $mark = $examresult->mark;
        $stmt->bindParam(1, $examID, PDO::PARAM_STR);
        $stmt->bindParam(2, $childID, PDO::PARAM_STR);
        $stmt->bindParam(3, $mark, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function delete($examresult){
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("examresults")
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $examID = $examresult->examinationID;
        $childID = $examresult->childID;
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $examID, PDO::PARAM_STR);
        
        
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function validID($resultclass): bool{
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("examresults"), array("*"))
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $examID = $resultclass->examinationID;
        $childID = $resultclass->childID;
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $examID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function update($examresult){
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("examresults", array("Marks"=>\CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $mark = $examresult->mark;
        $examID = $examresult->examinationID;
        $childID = $examresult->childID;
        $stmt->bindParam(1, $mark, PDO::PARAM_STR);
        $stmt->bindParam(2, $examID, PDO::PARAM_STR);
        $stmt->bindParam(3, $childID, PDO::PARAM_STR);
        
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function getResultByExaminationID($id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->SELECT(array("examresults","examination","child"), array("Marks","examresults.ChildID","ChildName","examresults.ExaminationID","ExamStartTime","ExamDuration","CourseCode"))
                ->where("examresults.ExaminationID", "examination.ExaminationID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
                ->where("examresults.ChildID", "child.ChildID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
                ->where("examresults.ExaminationID",\CustomSQLEnum::BIND_QUESTIONMARK)
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
            $resultList = array();
            foreach($results as $row){
                $exam = new Examination($row["ExaminationID"],$row["CourseCode"],"NA",$row["ExamStartTime"],$row["ExamDuration"]);
                $result = new ExamResult($exam, $row["ChildName"], $row["Marks"]);
                $resultList[] = $result;
            }
            return $resultList;
        }
    }
    public function getResultByClass($classID,$id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->SELECT(array("examresults","examination"), array("Marks","ChildID","examresults.ExaminationID","ExamStartTime","ExamDuration","CourseCode"))
                ->where("examresults.ExaminationID", "examination.ExaminationID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
                ->where("ClassID",\CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $classID, PDO::PARAM_STR);
        $stmt->bindParam(2, $id, PDO::PARAM_STR);
        
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return NULL;
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $resultList = array();
            foreach($results as $row){
                $exam = new Examination($row["ExaminationID"],$row["CourseCode"],"NA",$row["ExamStartTime"],$row["ExamDuration"]);
                $result = new ExamResult($exam, $id, $row["Marks"]);
                $resultList[] = $result;
            }
            return $resultList;
        }
    }
    public function getResult($id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->SELECT(array("examresults"), array("*"))
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->groupby("ClassID")
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
            $resultList = array();
            foreach($results as $row){
               
                $resultList[] = $row["ClassID"];
            }
            return $resultList;
        }
    }
    public function getResultByExamAndChild($examID, $childID){
        $builder = new MySQLQueryBuilder();
        $query = $builder->SELECT(array("examresults"), array("*"))
                ->where("ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->where("ChildID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $examID, PDO::PARAM_STR);
        $stmt->bindParam(2, $childID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return NULL;
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            return $row["Marks"];
        }
    }

    
}
