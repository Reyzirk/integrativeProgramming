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
require_once ( str_replace("AJAX", "", dirname(__DIR__))) . '/Function/AttendanceFacade.php';

$facade = new AttendanceFacade();
if ($submitBtn == false) {

    $totalRecords = $facade->getTotalAttendanceRecord();
    $attendanceRecords = $facade->selectAllAttendanceRecord();

    if ($totalRecords == 0) {
        ?>
        <tr>
            <td colspan="5" class="noRecordsFound"><b>NO RESULTS FOUND</b></td>
        </tr>
        <?php
    } else {
        foreach ($attendanceRecords as $row) {

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
                <td>
                    <button type="button" class="btn btn-primary" onclick="window.location.href = 'updateRecord.php?childID=<?php echo $row["ChildID"] ?>'"><i class="fa-solid fa-pen-to-square"></i>Update Record</button>
                </td>
            </tr>
            <?php
        }
        ?>

    <?php }
    ?>
    <?php
} else {
    if ($criteria == "name") {
        $searchResult = $facade->getAttendanceRecords($searchInfo);

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
                    <td>
                        <button type="button" class="btn btn-primary" onclick="window.location.href = 'updateRecord.php?childID=<?php echo $row["ChildID"] ?>'"><i class="fa-solid fa-pen-to-square"></i> Update Record</button>
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
    } else if ($criteria == "date") {
        
    }
}
?>
