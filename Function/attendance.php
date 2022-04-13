<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */ //Author: Ng Kar Kai
//require_once '/InstructorArea/Function/AttendanceFacade.php';
require_once str_replace("Function", "", dirname(__DIR__)) . "/InstructorArea/Function/AttendanceFacade.php";

//print_r(dir(__DIR__));

$facade = new AttendanceFacade();
$attendanceRecords = $facade->getAttendanceRecordFromParentID($parentID);
printSearchResults($attendanceRecords, $facade);

function printSearchResults($searchResult, $facade) {

    if ($searchResult != NULL) {
        foreach ($searchResult as $row) {
            $childName = $facade->getChildName($row["ChildID"]);
            $classDetails = $facade->getClassDetails($row["ChildID"]);
            ?>
            <tr id="<?php echo $row["AttendanceID"] ?>">
                <td>
            <?php echo $row["ChildID"] ?>
                </td>
                <td>
                    <?php echo $childName ?>
                </td>
                <td>
                    <?php echo $row["ChildTemperature"] ?>
                </td>
                <td>
                    <?php echo "S" . $classDetails->semester . "Y" . $classDetails->year ?>
                </td>
                <td>
                    <?php echo $row["AttendingDate"] ?>
                </td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="5" class="noRecordsFound"><b>NO RESULTS FOUND</b></td>
        </tr>
        <?php
    }
}
?>

