<?php

/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * InstructorArea/Functions/child.php
 * 
 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildClassDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ParentDB.php";

$dataArray = array(
    "childID" =>
    array(
        "Title" => "Parent ID",
        "Width" => "18%"),
    "parentID" =>
    array(
        "Title" => "Parent Name",
        "Width" => "30%"),
    "childName" =>
    array(
        "Title" => "Parent Email",
        "Width" => "30%"),
    "birthDate" =>
    array(
        "Title" => "Parent Phone No",
        "Width" => "40%"),
    "childIcNo" =>
    array(
        "Title" => "Parent Ic No",
        "Width" => "40%"),
    "status" =>
    array(
        "Title" => "Parent Type",
        "Width" => "25%"));

