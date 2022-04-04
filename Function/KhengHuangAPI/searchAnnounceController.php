<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */
require_once str_replace("InstructorArea", "", str_replace("Function", "", dirname(__DIR__))) . '/Database/AnnouncementDB.php';

function searchAnnouncement($search) {
    $announceDB = new AnnouncementDB();
    try {
        $totalCount = $announceDB->getCountBySearch($search);
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"] == true) {
            echo $ex->getMessage();
        } else {
            callPDOExceptionLog($ex);
        }
    }

    try {
        $results = $announceDB->searchAnnounce($search);
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"] == true) {
            echo $ex->getMessage();
        } else {
            callPDOExceptionLog($ex);
        }
    }
    return $results;
}

