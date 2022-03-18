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

    public function getAllID() {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("attachment"), array("AttachID"))
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
                ->values(array($attach->attachID, $attach->announce->announceID,$attach->attachName, $attach->filePath))
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
        $query = $builder->select(array("attachment"), array("*"))
                ->where("AttachID", $id)
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
            $result = new Attachment($row["AttachID"], $row["AnnounceID"],$row["AttachName"], $row["FilePath"]);
            $resultList = $result;
            return $resultList;
        }
    }

    public function delete($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("attachment")
                ->where("AttachID", $id)
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
        $query = $builder->update("attachment", array("AttachName" => $updated->attachName, "FilePath" => $updated->filePath))
                ->where("AttachID", $oldID)
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

}
