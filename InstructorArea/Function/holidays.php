<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of holidays backend
 *
 * @author Choo Meng
 */
$dataArray = array(
    "name" =>
    array(
        "Title" => "Holiday",
        "Width" => "60%"),
    "startDate" =>
    array(
        "Title" => "Date",
        "Width" => "30%"));

function callLog() {
    if (!empty($_SESSION["errorLog"])) {

        if ($_SESSION["errorLog"] == "noid") {
            $errorMsg = "Invalid Holiday ID";
        }
        ?>
        <script>
            Toast.fire({
                icon: 'error',
                html: '<b>Failed</b><br/><?php echo $errorMsg; ?>.'
            })
        </script>
        <?php
        unset($_SESSION["errorLog"]);
    }
    if (!empty($_SESSION["modifyLog"])) {

        if ($_SESSION["modifyLog"] == "createholiday") {
            $successMsg = "Created new holiday.";
        }else if ($_SESSION["modifyLog"] == "editholiday") {
            $successMsg = "Edited an existing holiday details.";
        }
        ?>
        <script>
            Toast.fire({
                icon: 'success',
                html: '<b>Sucessful</b><br/><?php echo $successMsg; ?>.'
            })
        </script>
        <?php
        unset($_SESSION["errorLog"]);
    }
}
