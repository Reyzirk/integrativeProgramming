<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once ( str_replace("AJAX", "", dirname(__DIR__))) . '/Function/AttendanceFacade.php';
$facade = new AttendanceFacade();

if ($submitBtn == false) {
    $query = "SELECT * FROM classes";
    $classesRecord = $facade->selectClasses($query);
    $classCount = $facade->getClassCount();
    printResults($classCount, $classesRecord);
} else {
    $query = "SELECT * FROM classes WHERE ClassID LIKE '%$searchInfo%'";
    $classesRecord=$facade->selectClasses($query);
    $classCount = $facade->getClassCountSearch($searchInfo);
    printResults($classCount,$classesRecord);
}

function printResults($classCount, $classesRecord) {
    if ($classCount == 0) {
        ?>
        <tr>
            <td colspan="5" class="noRecordsFound"><b>NO RESULTS FOUND</b></td>
        </tr>
        <?php
    } else {
        foreach ($classesRecord as $row) {
            ?>
            <tr>
                <td><?php echo $row["ClassID"] ?></td>
                <td><?php echo $row["Semester"] ?></td>
                <td><?php echo $row["Year"] ?></td>>
                <td>
                    <button type="button" class="btn btn-primary" onclick="window.location.href = 'insertChildAttendance.php?classID=<?php echo $row["ClassID"]?>'"><i class="fa-solid fa-pen-to-square"></i>Take Attendance</button>
                </td>
            </tr>
            <?php
        }
    }
}
?>
