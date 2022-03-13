<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 * 
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Announcement.php";

if(!empty($_POST['submit'])){
    $date = trim($_POST["hiddenDate"]);
    $title = trim($_POST["title"]);
    $desc = trim($_POST["desc"]);
    $cat = trim($_POST["cat"]);
    //file
    $allowC = trim($_POST["allowC"]);
    $pinTop = trim($_POST["pinTop"]);
    
    if(strcmp($allowC, "checked")==0){
        $allowC = 1;
    }else{
        $allowC = 0;
    }
    if(strcmp($pinTop, "checked")==0){
        $pinTop = 1;
    }else{
        $pinTop = 0;
    }
    
    $announce = new Announcement($annouceID, $instructorID, $title, $desc, $cat, $date, $pin, $allowC);
            
    // Connect Database
}




