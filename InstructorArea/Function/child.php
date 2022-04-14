<?php

/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * InstructorArea/Functions/child.php
 * 
 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ChildDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ParentDB.php";

$query = "SELECT * FROM child";
$childDB = new ChildDB();

$results = $childDB->select($query);

foreach ($results as $row) {
    $childID = $row["ChildID"];
    $parentID = $row["ParentID"];
    $name = $row["ChildName"];
    $birthdate = $row["ChildBirth"];
    $ic = $row["ChildIcNo"];
    $status = $row["Status"];
    ?>
    <tr id = "<?php echo $childID?>">
        <td><?php echo $childID;?></td>
        <td><?php echo $parentID; ?></td>
        <td><?php echo $name;?></td>
        <td><?php echo $parentEmail;?></td>
        <td><?php echo $birthdate?></td>
        <td><?php echo $ic?></td>
        <td><?php echo $status?></td>
        <td>
<!--            <button type="button" class="btn btn-primary" onclick = "window.location.href = 'addChild.php?parentID=<?php echo $parentID?>'" >Add Child</button>-->
            <button type="button" class="btn btn-primary" onclick = "window.location.href = 'viewChildDetails.php?id=<?php echo $parentID?>'" >View Child</button>
        </td>
    </tr>
    <?php

}
?>


