<?php
include '../Function/load.php';
include 'Function/insertChildAttendance.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        include './Components/headmeta.php';
        ?>
        <title>Record child Attendances</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="viewClassAttendance.php">Class Attendance List</a></li>
                        <li class="breadcrumb-item active"><a href="insertChildAttendance.php">Record Child Attendance</a></li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <br>
                                <h1 class="display-4">Children Attendance</h1>
                                <p class="lead">Take children attendances here</p>
                                <hr class="my-3">
                                <form method="POST" id="takeChildrenAttendance" name="takeChildrenAttendance">
                                    <fieldset class="form-group">
                                        <legend>
                                            Tick options that are applicable.
                                        </legend>
                                        <div class="row">
                                            <div class="col-md">
                                                Date Today: <?php echo date("Y/m/d") . " " . date("l") ?>
                                                <input type="hidden" name="hiddenDate" value="<?php echo date("Y/m/d") ?>"/>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 30%">Child ID</th>
                                                    <th scope="col"style="width: 35%">Child Name</th>
                                                    <th scope="col"style="width: 20%">Temperature</th>
                                                    <th scope="col"style="width: 15%">Attendance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php include 'Function/recordChildAttendance.php';?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex flex-row-reverse">
                                            <input class="btn btn-primary p-2" type="submit" value="Submit Attendance Record" name="submitAttendanceRecord">
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
