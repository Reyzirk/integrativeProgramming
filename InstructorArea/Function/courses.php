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
    "code" =>
    array(
        "Title" => "Course Code",
        "Width" => "30%"),
    "name" =>
    array(
        "Title" => "Name",
        "Width" => "50%"));

function callLog() {
    if (!empty($_SESSION["errorLog"])) {

        if ($_SESSION["errorLog"] == "noid") {
            $errorMsg = "Invalid Course Code";
        }
        ?>
        <script>
            $(document).ready(function(){
                setTimeout(function (){
                    Toast.fire({
                        icon: 'error',
                        html: '<b>Failed</b><br/><?php echo $errorMsg; ?>.'
                    })
                },3000);
            });
            
        </script>
        <?php
        unset($_SESSION["errorLog"]);
    }
    if (!empty($_SESSION["modifyLog"])) {

        if ($_SESSION["modifyLog"] == "createcourse") {
            $successMsg = "Created new course.";
        }else if ($_SESSION["modifyLog"] == "editcourse") {
            $successMsg = "Edited an existing course details.";
        }
        ?>
        <script>
            $(document).ready(function(){
                setTimeout(function (){
                    Toast.fire({
                        icon: 'success',
                        html: '<b>Sucessful</b><br/><?php echo $successMsg; ?>.'
                    })
                },3000);
            });
        </script>
        <?php
        unset($_SESSION["modifyLog"]);
    }
}
