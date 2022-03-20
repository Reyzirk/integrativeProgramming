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
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Enum/EnumLoad.php';

class AnnouncementDB {

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
        $query = $builder->select(array("announcement"), array("*"))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        return $totalrows;
    }

    public function getAllID() {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("announcement"), array("AnnounceID"))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        
        $resultList = array();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return $resultList;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $row) {
                $result = $row["AnnounceID"];
                $resultList[] = $result;
            }
            return $resultList;
        }
    }

    public function list() {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("announcement"), array("*"))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $resultList = array();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return $resultList;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $row) {
                $result = new Announcement($row["AnnounceID"], $row["InstructorID"], $row["Title"], $row["Description"], $row["Cat"], $row["Date"], $row["Pin"], $row["AllowComment"]);
                $resultList[] = $result;
            }
            return $resultList;
        }
    }

    public function insert($announce) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("announcement")
                ->values(array($announce->announceID, $announce->instructorID, $announce->title, $announce->desc, $announce->cat,
                    $announce->date, $announce->pin, $announce->allowC))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function details($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("announcement"), array("*"))
                ->where("AnnounceID", $id)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return NULL;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            $row = $results[0];
            $result = new Announcement($row["AnnounceID"], $row["InstructorID"], $row["Title"], $row["Description"],
                    $row["Cat"], $row["Date"], $row["Pin"], $row["AllowComment"]);
            $resultList = $result;
            return $resultList;
        }
    }

    public function delete($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("announcement")
                ->where("AnnounceID", $id)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function update($oldID, $updated) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("announcement", array("Title"=>\CustomSQLEnum::BIND_QUESTIONMARK, 
            "Description"=>\CustomSQLEnum::BIND_QUESTIONMARK, 
            "Cat"=>\CustomSQLEnum::BIND_QUESTIONMARK, 
            "Date"=>\CustomSQLEnum::BIND_QUESTIONMARK, 
            "Pin"=>\CustomSQLEnum::BIND_QUESTIONMARK, 
            "AllowComment"=>\CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("AnnounceID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $announceID = $oldID;
        $title = $updated->title;
        $desc = $updated->desc;
        $cat = $updated->cat;
        $date = $updated->date;
        $pin = $updated->pin;
        $allowC = $updated->allowC;
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $desc, PDO::PARAM_STR);
        $stmt->bindParam(3, $cat, PDO::PARAM_STR);
        $stmt->bindParam(4, $date, PDO::PARAM_STR);
        $stmt->bindParam(5, $pin, PDO::PARAM_STR);
        $stmt->bindParam(6, $allowC, PDO::PARAM_STR);
        $stmt->bindParam(7, $oldID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows==0){
            return false;
        }else{
            return true;
        }
    }

}
