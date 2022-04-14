<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================

 InstructorArea/Functions/parent.php

 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ParentDB.php";

$dataArray = array(
    "parentID" =>
    array(
        "Title" => "Parent ID",
        "Width" => "18%"),
    "parentName" =>
    array(
        "Title" => "Parent Name",
        "Width" => "30%"),
    "parentEmail" =>
    array(
        "Title" => "Parent Email",
        "Width" => "30%"),
    "parentPhoneNo" =>
    array(
        "Title" => "Parent Phone No",
        "Width" => "40%"),
    "parentIcNo" =>
    array(
        "Title" => "Parent Ic No",
        "Width" => "40%"),
    "parentType" =>
    array(
        "Title" => "Parent Type",
        "Width" => "25%"));


