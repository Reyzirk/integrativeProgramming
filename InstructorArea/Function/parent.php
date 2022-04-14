<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================

  InstructorArea/Functions/parent.php

 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ParentDB.php";

$query = "SELECT * FROM parent";
$parentDB = new ParentDB();

$results = $parentDB->select($query);

foreach ($results as $row) {
    $parentID = $row["ParentID"];
    $parentName = $row["ParentName"];
    $parentGender = $row["ParentGender"];
    $parentBirthdate = $row["ParentBirth"];
    $parentEmail = $row["ParentEmail"];
    $parentPhoneNo = $row["ParentPhoneNo"];
    $parentIC = $row["ParentIcNo"];
    $parentType = $row["ParentType"];
    $addressID = $row["AddressID"];
    //$password = $row["Password"];
    ?>
    <tr id = "<?php echo $parentID?>">
        <td><?php echo $parentID; ?></td>
        <td><?php echo $parentName;?></td>
        <td><?php echo $parentEmail;?></td>
        <td><?php echo $parentPhoneNo?></td>
        <td><?php echo $parentIC?></td>
        <td><?php echo $parentType?></td>
        <td>
            <button type="button" class="btn btn-primary" onclick = "window.location.href = 'addChild.php?parentID=<?php echo $parentID?>'" >Add Child</button>
            <button type="button" class="btn btn-primary" onclick = "window.location.href = 'viewChildDetails.php?id=<?php echo $parentID?>'" >View Child</button>
        </td>
    </tr>
    <?php

}
?>
