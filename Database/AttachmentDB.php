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
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Attachment.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Announcement.php";

class AttachmentDB {

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
        $query = $builder->select(array("attachment"), array("*"))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        return $totalrows;
    }

    public function getCountByAID($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("attachment"), array("*"))
                ->where("AnnounceID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        return $totalrows;
    }

    public function getAllID() {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("attachment"), array("AttachID"))
                ->order("AttachID", \OrderTypeEnum::ASC)
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
                $result = $row["AttachID"];
                $resultList[] = $result;
            }
            return $resultList;
        }
    }

    public function insert($attach) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("attachment")
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $attachID = $attach->attachID;
        $announceID = $attach->announce->announceID;
        $attachName = $attach->attachName;
        $filePath = $attach->filePath;
        $stmt->bindParam(1, $attachID, PDO::PARAM_STR);
        $stmt->bindParam(2, $announceID, PDO::PARAM_STR);
        $stmt->bindParam(3, $attachName, PDO::PARAM_STR);
        $stmt->bindParam(4, $filePath, PDO::PARAM_STR);
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
        $query = $builder->select(array("attachment"), array("*"))
                ->where("AnnounceID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return NULL;
        } else {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $results = $stmt->fetchAll();
            foreach ($results as $row) {
                $result = new Attachment($row["AttachID"], new Announcement($row["AnnounceID"]), $row["AttachName"], $row["FilePath"]);
                $resultList[] = $result;
            }
            return $resultList;
        }
    }

    public function delete($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("attachment")
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

    public function update($oldID, $updated) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->update("attachment", array("AttachName" => \CustomSQLEnum::BIND_QUESTIONMARK, "FilePath" => \CustomSQLEnum::BIND_QUESTIONMARK))
                ->where("AttachID", \CustomSQLEnum::BIND_QUESTIONMARK)
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $attachName = $updated->attachName;
        $filePath = $updated->filePath;
        $stmt->bindParam(1, $attachName, PDO::PARAM_STR);
        $stmt->bindParam(2, $filePath, PDO::PARAM_STR);
        $stmt->bindParam(3, $oldID, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        } else {
            return true;
        }
    }

}
