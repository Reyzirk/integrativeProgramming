<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/DBController.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/MySQLQueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Announcement.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/ReadStatus.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Enum/EnumLoad.php';

class ReadStatusDB{
     private $instance;

    public function __construct() {
        $this->instance = DBController::getInstance();
    }

    public function select($query) {

        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return NULL;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
    }

    public function getCount() {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("readstatus"), array("*"))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        return $totalrows;
    }
    
    public function getCountByAID($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("readstatus"), array("*"))
                ->where("AnnounceID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        return $totalrows;
    }

    public function list($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("status"), array("*"))
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultList = array();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return $resultList;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $row) {
                $result = new ReadStatus($row["ParentID"], $row["AnnounceID"], $row["Date"]);
                $resultList[] = $result;
            }
            return $resultList;
        }
    }

    public function insert($read) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("readstatus")
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, 
                    \CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        
        $parentID = $read->parentID;
        $announceID = $read->announceID;
        $date = $read->date;
        
        $stmt->bindParam(1, $parentID, PDO::PARAM_STR);
        $stmt->bindParam(2, $announceID, PDO::PARAM_STR);
        $stmt->bindParam(3, $date, PDO::PARAM_STR);
        

        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function checkExist($read) {
        $parentID = $read->parentID;
        $announceID = $read->announceID;
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("readstatus"), array("*"))
                ->where("ParentID", $parentID, WhereTypeEnum::AND, OperatorEnum::EQUAL,true)
                ->where("AnnounceID", $announceID, WhereTypeEnum::AND, OperatorEnum::EQUAL,true)
                ->bracketWhere(WhereTypeEnum::AND)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return 0;
        } else {
            return 1;
        }
    }
  

    public function delete($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("readstatus")
                ->where("ParentID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function deleteByAnnounceID($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("readstatus")
                ->where("AnnounceID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }
}
