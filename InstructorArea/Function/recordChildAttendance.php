<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Author: Ng Kar Kai
require_once ( str_replace("AJAX", "", dirname(__DIR__))) . '/Function/AttendanceFacade.php';
$facade = new AttendanceFacade();

if ($submitBtn == false) {

    $query = "SELECT * FROM childclass WHERE ClassID = '$classID'";
    $childIDRecord = $facade->getChildIDFromClassID($query);

    if (is_null($childIDRecord) == true) {
        ?>
        <tr>
            <td colspan="5" class="noRecordsFound"><b>NO RESULTS FOUND</b></td>
        </tr>
        <?php
    } else {
        
        printResults($childIDRecord, $todayDate,$facade,$classID);
    }
} else {
    
}

function printResults($childIDRecord, $todayDate,$facade,$classID) {
    foreach ($childIDRecord as $rowRecord) {
        $childID = $rowRecord["ChildID"];
        $childName = $facade->getChildName($childID);
        ?>
        <tr>
            <td><?php echo $childID ?></td>
            <td><?php echo $childName ?></td>
            <td>
                <?php echo $classID?>
            </td>
            <td>
                <button type="button" class="btn btn-primary" 
                    <?php echo $facade->checkIfAttendanceExists($childID, $todayDate) ? "disabled":"" ?> onclick="window.location.href = 'updateNewAttendance.php?childID=<?php echo $childID?>'">
                    <i class="fa-solid fa-pen-to-square"></i>Take Attendance</button>
            </td>
        </tr>
        <?php
    }
}
?>
