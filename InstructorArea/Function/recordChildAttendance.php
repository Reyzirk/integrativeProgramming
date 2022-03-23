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
        printResults($childIDRecord, $todayDate,$facade);
    }
} else {
    
}

function printResults($childIDRecord, $todayDate,$facade) {
    foreach ($childIDRecord as $rowRecord) {
        $childID = $rowRecord["ChildID"];
        $childName = $facade->getChildName($childID);
        ?>
        <tr>
            <td><?php echo $childID ?></td>
            <td><?php echo $childName ?></td>
            <td style="text-align: center; vertical-align: middle;">
                <input class="bg-white form-control w-50" type="number" step="0.1" min="36.0" value="36.0" placeholder="Enter <?php echo $childName . "'s" ?> temperature here." name="temperatureInput"/>
            </td>>
            <td style="text-align: center; vertical-align: middle;">
                <input name="attendanceCheck" type="checkbox" 
                    <?php echo $facade->checkIfAttendanceExists($childID, $todayDate) ? "checked" : "" ?> value="<?php echo $facade->checkIfAttendanceExists($childID, $todayDate) ? "attendanceTaken" : "" ?>">
            </td>
        </tr>
        <?php
    }
}
?>
