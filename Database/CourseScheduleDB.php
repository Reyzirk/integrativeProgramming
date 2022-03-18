<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of CourseScheduleDB
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/CourseSchedule.php';
class CourseScheduleDB {
    private $instance;
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    public function getCount($search,$id){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("courseschedule","classes","instructor"), array("courseschedule.CourseCode",
            "courseschedule.ClassID","courseschedule.InstructorID","TimeStart","Duration","ClassType","Day"))
        ->where("courseschedule.CourseCode", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("TimeStart", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Duration", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ClassType", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Day", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("courseschedule.ClassID", "classes.ClassID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("courseschedule.InstructorID", "instructor.InstructorID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("courseschedule.ClassID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
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
    public function insert($schedule){
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("courseschedule")
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,
                    \CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $scheduleID = $schedule->scheduleID;
        $courseCode = $schedule->courseCode;
        $classID = $schedule->classID;
        $instructor = $schedule->instructor;
        $timeStart = $schedule->timeStart;
        $duration = $schedule->duration;
        $classtype = $schedule->classType;
        $day = $schedule->day;
        $stmt->bindParam(1, $scheduleID, PDO::PARAM_STR);
        $stmt->bindParam(2, $courseCode, PDO::PARAM_STR);
        $stmt->bindParam(3, $classID, PDO::PARAM_STR);
        $stmt->bindParam(4, $instructor, PDO::PARAM_STR);
        $stmt->bindParam(5, $timeStart, PDO::PARAM_STR);
        $stmt->bindParam(6, $duration, PDO::PARAM_INT);
        $stmt->bindParam(7, $classtype, PDO::PARAM_STR);
        $stmt->bindParam(8, $day, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }
    public function delete($scheduleID){
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("courseschedule")
                ->where("ScheduleID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $scheduleID, PDO::PARAM_STR);
        
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
        $query = $builder->select(array("courseschedule"), array("*"))
                ->where("ScheduleID", \CustomSQLEnum::BIND_QUESTIONMARK)
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
            $result = new CourseSchedule($row["ScheduleID"],$row["CourseCode"],$row["ClassID"],$row["InstructorID"],$row["TimeStart"],$row["Duration"],$row["ClassType"],$row["Day"]);
            $resultList = $result;
            return $resultList;
        }
    }
    public function update($schedule){
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("courseschedule", array("CourseCode"=>\CustomSQLEnum::BIND_QUESTIONMARK,"InstructorID"=>\CustomSQLEnum::BIND_QUESTIONMARK
                ,"TimeStart"=>\CustomSQLEnum::BIND_QUESTIONMARK,"Duration"=>\CustomSQLEnum::BIND_QUESTIONMARK,"ClassType"=>\CustomSQLEnum::BIND_QUESTIONMARK,"Day"=>\CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("ScheduleID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $scheduleID = $schedule->scheduleID;
        $courseCode = $schedule->courseCode;
        $instructor = $schedule->instructor;
        $timeStart = $schedule->timeStart;
        $duration = $schedule->duration;
        $classtype = $schedule->classType;
        $day = $schedule->day;
        $stmt->bindParam(1, $courseCode, PDO::PARAM_STR);
        $stmt->bindParam(2, $instructor, PDO::PARAM_STR);
        $stmt->bindParam(3, $timeStart, PDO::PARAM_STR);
        $stmt->bindParam(4, $duration, PDO::PARAM_INT);
        $stmt->bindParam(5, $classtype, PDO::PARAM_STR);
        $stmt->bindParam(6, $day, PDO::PARAM_STR);
        $stmt->bindParam(7, $scheduleID, PDO::PARAM_STR);
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
        $query = $builder->select(array("courseschedule"), array("*"))
                ->where("ScheduleID", \CustomSQLEnum::BIND_QUESTIONMARK)
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
}
