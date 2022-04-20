<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Author: Ng Kar Kai
require_once str_replace("InstructorArea", "", str_replace("Demo", "", dirname(__DIR__))) . "/Objects/Attendance.php";

    $apiKey = "d61a42d239989eb9df075a70b5ad0e1435f7b186";
//print_r($childName);
if ($btnClicked == true) {
    $apiKey = "d61a42d239989eb9df075a70b5ad0e1435f7b186";
    $page = file_get_contents("http://localhost/integrativeProgramming/KarKaiAPI/ReadAttendance.php?key=$apiKey&childname=$childName");
    $jsonStr = json_decode($page)[0];

    //print_r($jsonStr);
    printJsonResults($jsonStr);
} else {
    $apiKey = "d61a42d239989eb9df075a70b5ad0e1435f7b186";
    $page = file_get_contents("http://localhost/integrativeProgramming/KarKaiAPI/ReadAttendance.php?key=$apiKey");
    //$page = file_get_contents("http://localhost/IntegrativeProgramming/integrativeProgramming/KarKaiAPI/ReadAttendance.php?key=$apiKey");
    $jsonStr = json_decode($page)[0];
    
    printJsonResults($jsonStr);
    
}

function printJsonResults($jsonStr) {
    $childTemperature = "Child Temperature";
    $totalCount = $jsonStr->TotalRecords;
    if ($jsonStr->Status == "Successful") {
        $dataStr = $jsonStr->AttendanceList;
        //print_r($dataStr);
        foreach ($dataStr as $data) {
            ?>
            <tr>
                <td class="text-center">
            <?php echo $data->AttendanceID; ?>
                </td>
                <td class="text-center">
            <?php echo $data->ChildID; ?>
                </td>
                <td class="text-center">
            <?php echo $data->$childTemperature; ?>
                </td>
                <td class="text-center">
            <?php echo $data->AttendingDate; ?>
                </td>
            </tr>

            <?php
        }

        if (empty($dataStr) || $totalCount == 0) {
            ?>
            <tr>
                <td colspan='4'height='60px' class='emptySlot'>
                    <b>NO RESULT FOUND</b>
                </td>
            </tr>
            <?php
        }
    }
}
?>

