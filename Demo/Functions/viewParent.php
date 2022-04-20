<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", str_replace("Demo", "", dirname(__DIR__))) . "/Objects/Parents.php";

$apiKey = "d61a42d239989eb9df075a70b5ad0e1435f7b186";

$page = file_get_contents("http://localhost/integrativeProgramming/KhaiLiAPI/readParentData.php?key=$apiKey");
$jsonStr = json_decode($page)[0];

if ($jsonStr->Status == "Successful") {
    $parentData = $jsonStr->ParentList;

    foreach ($parentData as $data) {
        ?>
        <tr>
            <td class="text-center">
                <?php echo $data->ParentName ?>
            </td>
            <td class="text-center">
                <?php echo $data->ParentGender ?>
            </td>
            <td class="text-center">
                <?php echo $data->ParentBirth ?>
            </td>
            <td class="text-center">
                <?php echo $data->ParentEmail ?>
            </td>
            <td class="text-center">
                <?php echo $data->ParentPhone ?>
            </td>
            <td class="text-center">
                <?php echo $data->ParentIcNo?>
            </td>
            <td class="text-center">
                <?php echo $data->ParentType ?>
            </td>
        </tr>
        <?php
    }

    if (empty($parentData)) {
        ?>
        <tr>
            <td colspan='4'height='60px' class='emptySlot'>
                <b>NO RESULT FOUND</b>
            </td>
        </tr>
        <?php
    }
}
?>
 
