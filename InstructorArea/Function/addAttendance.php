<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of addAttendance
 *
 * @author Ng Kar Kai
 */
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/AttendanceDB.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/ChildDB.php';
$attendanceDB = new AttendanceDB();
$childDB = new ChildDB();
$totalRecords = $attendanceDB->getRecordCount();
$attendanceRecords = $attendanceDB->selectAll();


if ($totalRecords == 0) {
    ?>
    <tr>
        <td colspan="3" class="noRecordsFound"><b>NO RESULTS FOUND</b></td>
    </tr>
    <?php
} else {
    foreach ($attendanceRecords as $row) {

        $childDetails = $childDB->getChildDetails($row["ChildID"]);
        $childName = $childDetails->childName;
        ?>
        <tr id="<?php echo $row["AttendanceID"] ?>">
            <td>
                <?php echo $row["ChildID"] ?>
            </td>
            <td>
                <?php echo $childName?>
            </td>
            <td>
                <?php echo $row["ChildTemperature"] ?>
            </td>
            <td>
                <button type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>Update Record</button>
            </td>
        </tr>
        <?php
    }
    ?>

<?php }
?>
