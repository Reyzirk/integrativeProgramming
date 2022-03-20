<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * Function/announcement.php
 * 
 * @author Oon Kheng Huang
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/AnnouncementDB.php";

$dataArray = array(
    "announceID" =>
    array(
        "Title" => "Announcement ID",
        "Width" => "20%"),
    "date" =>
    array(
        "Title" => "Date",
        "Width" => "20%"),
    "homeworkDesc" =>
    array(
        "Title" => "Title",
        "Width" => "30%"),
    array(
        "Title" => "Category",
        "Width" => "15%")
    );




