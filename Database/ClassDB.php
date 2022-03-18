<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of ClassDB
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Classes.php';
class ClassDB {
    private $instance;
    public function __construct(){
        $this->instance = DBController::getInstance();
    }
    public function getCount($search){
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("classes","instructor"), array("*"))
        ->where("ClassID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Semester", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Year", "%$search%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ClassStart", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("instructor.InstructorID", "classes.InstructorID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
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
    public function insert($class){
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("classes")
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK,\CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $class->classID, PDO::PARAM_STR);
        $stmt->bindParam(2, $class->semester, PDO::PARAM_INT);
        $stmt->bindParam(3, $class->year, PDO::PARAM_INT);
        $stmt->bindParam(4, $class->formTeacher, PDO::PARAM_STR);
        $stmt->bindParam(5, $class->classStart, PDO::PARAM_STR);
        $stmt->bindParam(6, $class->classEnd, PDO::PARAM_STR);
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
        $query = $builder->delete("classes")
                ->where("classes.ClassID", \CustomSQLEnum::BIND_QUESTIONMARK)
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
        $query = $builder->select(array("classes"), array("*"))
                ->where("classes.ClassID", \CustomSQLEnum::BIND_QUESTIONMARK)
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
            $result = new Classes($row["ClassID"],$row["Semester"],$row["Year"],$row["InstructorID"],$row["ClassStart"],$row["ClassEnd"]);
            $resultList = $result;
            return $resultList;
        }
    }
    public function update($oldID, $updated){
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("classes", array("Semester"=>\CustomSQLEnum::BIND_QUESTIONMARK,"Year"=>\CustomSQLEnum::BIND_QUESTIONMARK
                ,"InstructorID"=>\CustomSQLEnum::BIND_QUESTIONMARK,"ClassStart"=>\CustomSQLEnum::BIND_QUESTIONMARK,"ClassEnd"=>\CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("ClassID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $semester = $updated->semester;
        $year = $updated->year;
        $formTeacher = $updated->formTeacher;
        $classStart = $updated->classStart;
        $classEnd = $updated->classEnd;
        $stmt->bindParam(1, $semester, PDO::PARAM_INT);
        $stmt->bindParam(2, $year, PDO::PARAM_INT);
        $stmt->bindParam(3, $formTeacher, PDO::PARAM_STR);
        $stmt->bindParam(4, $classStart, PDO::PARAM_STR);
        $stmt->bindParam(5, $classEnd, PDO::PARAM_STR);
        $stmt->bindParam(6, $oldID, PDO::PARAM_STR);
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
        $query = $builder->select(array("classes"), array("*"))
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

}
