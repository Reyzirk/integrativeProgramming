<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of ExaminationDB
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Examination.php';
class ExaminationDB {
    private $instance;
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    public function getCount($search){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("examination","instructor"), array("*"))
        ->where("ExaminationID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("CourseCode", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ExamDuration", $search, WhereTypeEnum::OR, OperatorEnum::EQUAL)
        ->where("ExamStartTime", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("examination.InstructorID", "instructor.InstructorID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
        ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        return $totalrows;
    }
    public function getCountWithID($search,$id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("examination"), array("examination.ExaminationID","CourseCode","InstructorName","ExamDuration","ExamStartTime","Marks"))
        ->join("instructor","examination.InstructorID","instructor.InstructorID")
        ->join("examresults","examination.ExaminationID","examresults.ExaminationID")
        ->join("childclass","examresults.ChildID","childclass.ChildID")
        ->where("examination.ExaminationID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("CourseCode", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ExamDuration", $search, WhereTypeEnum::OR, OperatorEnum::EQUAL)
        ->where("ExamStartTime", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Marks", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("childclass.ClassID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        return $totalrows;
    }
    public function getCountWithIDAndChild($search,$id,$cid){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("examination"), array("examination.ExaminationID","CourseCode","InstructorName","ExamDuration","ExamStartTime","Marks"))
        ->join("instructor","examination.InstructorID","instructor.InstructorID")
        ->join("examresults","examination.ExaminationID","examresults.ExaminationID")
        ->join("childclass","examresults.ChildID","childclass.ChildID")
        ->where("examination.ExaminationID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("CourseCode", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ExamDuration", $search, WhereTypeEnum::OR, OperatorEnum::EQUAL)
        ->where("ExamStartTime", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Marks", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("childclass.ClassID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->where("examresults.ChildID", $cid, WhereTypeEnum::AND, OperatorEnum::EQUAL)
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
    public function insert($exam){
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("examination")
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $examinationID = $exam->examinationID;
        $course = $exam->course;
        $examiner = $exam->examiner;
        $examStartTime = $exam->examStartTime;
        $examDuration = $exam->examDuration;
        $stmt->bindParam(1, $examinationID, PDO::PARAM_STR);
        $stmt->bindParam(2, $course, PDO::PARAM_STR);
        $stmt->bindParam(3, $examiner, PDO::PARAM_STR);
        $stmt->bindParam(4, $examStartTime, PDO::PARAM_STR);
        $stmt->bindParam(5, $examDuration, PDO::PARAM_INT);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function delete($id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("examination")
                ->where("ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK)
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
    public function details($id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("examination"), array("*"))
                ->where("examination.ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK)
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
            $result = new Examination($row["ExaminationID"],$row["CourseCode"],$row["InstructorID"],$row["ExamStartTime"],$row["ExamDuration"]);
            $resultList = $result;
            return $resultList;
        }
    }
    public function update($oldID, $updated){
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("examination", array("CourseCode"=>\CustomSQLEnum::BIND_QUESTIONMARK,"InstructorID"=>\CustomSQLEnum::BIND_QUESTIONMARK
                ,"ExamStartTime"=>\CustomSQLEnum::BIND_QUESTIONMARK,"ExamDuration"=>\CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $course = $updated->course;
        $examiner = $updated->examiner;
        $starttime = $updated->examStartTime;
        $duration = $updated->examDuration;
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $course, PDO::PARAM_STR);
        $stmt->bindParam(2, $examiner, PDO::PARAM_STR);
        $stmt->bindParam(3, $starttime, PDO::PARAM_STR);
        $stmt->bindParam(4, $duration, PDO::PARAM_INT);
        $stmt->bindParam(5, $oldID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function updateCourseCode($oldID, $newID){
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("examination", array("CourseCode"=>\CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("CourseCode", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $newID, PDO::PARAM_STR);
        $stmt->bindParam(2, $oldID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function validID($id): bool{
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("examination"), array("*"))
                ->where("ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK)
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
    public function access($childID,$id): bool{
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("examination"), array("*"))
            ->join("instructor","examination.InstructorID","instructor.InstructorID")
            ->join("examresults","examination.ExaminationID","examresults.ExaminationID")
            ->join("childclass","examresults.ChildID","childclass.ChildID")
            ->where("examresults.ChildID", \CustomSQLEnum::BIND_QUESTIONMARK, WhereTypeEnum::AND, OperatorEnum::EQUAL)
            ->where("examination.ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK, WhereTypeEnum::AND, OperatorEnum::EQUAL)
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
    public function getClassID($examID, $childID){
        $builder = new MySQLQueryBuilder();
        $query = $builder->SELECT(array("examination"), array("childclass.ClassID"))
            ->join("instructor","examination.InstructorID","instructor.InstructorID")
            ->join("examresults","examination.ExaminationID","examresults.ExaminationID")
            ->join("childclass","examresults.ChildID","childclass.ChildID")
            ->where("examresults.ChildID", \CustomSQLEnum::BIND_QUESTIONMARK, WhereTypeEnum::AND, OperatorEnum::EQUAL)
            ->where("examination.ExaminationID", \CustomSQLEnum::BIND_QUESTIONMARK, WhereTypeEnum::AND, OperatorEnum::EQUAL)
            ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $childID, PDO::PARAM_STR);
        $stmt->bindParam(2, $examID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return NULL;
        }else{
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            return $row["ClassID"];
        }
    }

}
