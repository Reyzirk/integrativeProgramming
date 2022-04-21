<?php

/*
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * 
 * @author Tang Khai Li
 */

if (empty($_GET["id"])) {
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: parent.php');
}
else{
    $id = eliminateExploit2($_GET["id"]);
}

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Child.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/ChildClass.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ParentDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/InstructorDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Instructor.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Parents.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ChildDB.php";

function displayList(){
    
$childDB = new ChildDB();
$parentDB = new ParentDB();
$id = eliminateExploit2($_GET["id"]);

$getChild = $childDB->getChildList($id);
if (empty($getChild)) {
    die();
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: parent.php');
} else {
    foreach ($getChild as $child) {
        $parentID = $child["ParentID"];
        $parentResults = $parentDB->getParentDetails($parentID);
        foreach($parentResults as $parent){
            ?>
        <tr>
            <td><?php echo $child["ChildID"]?></td>
            <td><?php echo $parent["ParentName"]?></td>
            <td><?php echo $child["ChildName"]?></td>
            <td><?php echo $child["BirthDate"]?></td>
            <td><?php echo $child["ChildICNo"]?></td>
            <td><?php echo $child["Status"]?></td>
            <td><button  type="button" class="btn btn-primary" onclick="window.location.href = 'editChildStatus.php?childID=<?php echo $child["ChildID"]?>'" >Edit Status</button></td>
        </tr>
                 
        <?php
        }
    }
}
}

function eliminateExploit2($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
?>
