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
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/Comment.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Enum/EnumLoad.php';

class CommentDB{
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
        $query = $builder->select(array("comment"), array("*"))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        return $totalrows;
    }
    
    public function getCountByAID($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("comment"), array("*"))
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
        $query = $builder->select(array("comment"), array("CommentID"))
                ->order("CommentID", \OrderTypeEnum::ASC)
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
                $result = $row["CommentID"];
                $resultList[] = $result;
            }
            return $resultList;
        }
    }

    public function list($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->select(array("comment"), array("*"))
                ->where("AnnounceID", \CustomSQLEnum::BIND_QUESTIONMARK)
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
                $result = new Comment($row["CommentID"], $row["UserID"], new Announcement($row["AnnounceID"]), $row["Description"],  $row["Date"]);
                $resultList[] = $result;
            }
            return $resultList;
        }
    }

    public function insert($comment) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->insert("comment")
                ->values(array(\CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, 
                    \CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK, \CustomSQLEnum::BIND_QUESTIONMARK))
                ->query();
        $stmt = $this->instance->con->prepare($query);
        
        $commentID = $comment->commentID;
        $userID = $comment->userID;
        $announceID = $comment->announce->announceID;       
        $desc = $comment->desc;
        $date = $comment->date;
        
        $stmt->bindParam(1, $commentID, PDO::PARAM_STR);
        $stmt->bindParam(2, $userID, PDO::PARAM_STR);
        $stmt->bindParam(3, $announceID, PDO::PARAM_STR);
        $stmt->bindParam(4, $desc, PDO::PARAM_STR);
        $stmt->bindParam(5, $date, PDO::PARAM_STR);

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
        $query = $builder->select(array("comment"), array("*"))
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
            $row = $results[0];
            $result = new Comment($row["CommentID"], $row["UserID"], new Announcement($row["AnnounceID"]), $row["Description"],  $row["Date"]);
            $resultList = $result;
            return $resultList;
        }
    }

    public function delete($id) {
        $builder = new MySQLQueryBuilder();
        $query = $builder->delete("comment")
                ->where("CommentID", \CustomSQLEnum::BIND_QUESTIONMARK)
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



