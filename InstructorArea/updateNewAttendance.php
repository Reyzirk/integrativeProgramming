<?php
include '../Function/load.php';
include 'Function/updateAttendance.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
@author: Ng Kar Kai
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Attendance</title>
        <?php
        include './Components/headmeta.php';
        ?>
        <title>Update Student Attendance</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="announcement.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="viewClassAttendance.php">Class Attendance List</a></li>
                        <li class="breadcrumb-item "><a href="insertChildAttendance.php">Record Child Attendance</a></li>
                        <li class="breadcrumb-item active"><a href="updateNewAttendance.php">Update Child Attendance</a></li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <br>
                                <h1 class="display-4">Update <?php echo $childName . "'s" ?> Attendance</h1>
                                <p class="lead">Update <?php echo $childName . "'s" ?> attendances here </p>
                                <hr class="my-3">
                                <br>
                                <form method="POST" id="attendanceUpdate" name="updateAttendance">
                                    <fieldset>
                                        <legend>
                                            Log <?php echo $childName . "'s" ?> attendance for <?php echo $todayDate; ?>
                                        </legend>
                                        <div class="row">
                                            <div class="col-md">
                                                Date Today: <?php echo date("Y/m/d") . " " . date("l") ?>
                                                <input type="hidden" name="hiddenDate" value="<?php echo date("Y/m/d") ?>"/>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-md">
                                                <label class="col-form-label">Child Temperature:<span class="required">*</span></label>
                                                <input name = "temperature" class="bg-white form-control" type="number" step="0.1" min="36.0" value="36.0" placeholder="Enter <?php echo $childName . "'s" ?> temperature here."/>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md">
                                                <label class="col-form-label">Attendance Recorded By:</label>
                                                <input class="form-control" name = "instructorID" type="text" placeholder="<?php echo $_SESSION["instructorID"];?>" readonly>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="d-flex justify-content-center">
                                            <input class="btn btn-danger m-2" type="button" value="Back" onclick="history.back()">
                                            <input class="btn btn-primary m-2" type="submit" value="Submit" name="submitAttendance">
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
