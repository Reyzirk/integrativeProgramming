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
        <?php
        if (isset($_SESSION["attendanceExistError"])) {
            $error["attendanceExistErr"] = $_SESSION["attendanceExistError"];
            unset($_SESSION["attendanceExistError"]);
        }
        ?>
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
                                    <input type="hidden" name="prevPage" id="prevPage">
                                    <script>
                                        document.getElementById("prevPage").value = window.location.href;
                                    </script>
                                    <fieldset class="form-group">
                                        <legend>
                                            Select children's name to record temperature and take attendance
                                        </legend>
                                        <div class="row">
                                            <div class="col-md">
                                                Date Today: <?php echo date("Y/m/d") . " " . date("l") ?>
                                                <input type="hidden" name="hiddenDate" value="<?php echo date("Y/m/d") ?>"/>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <input type="<?php echo empty($error["attendanceExistErr"]) ? "hidden" : "textbox" ?>" <?php echo empty($error["attendanceExistErr"]) ? "" : "disabled" ?> 
                                               placeholder="<?php echo empty($error["attendanceExistErr"]) ? "" : $error["attendanceExistErr"] ?>">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 25%">Child ID</th>
                                                    <th scope="col"style="width: 30%">Child Name</th>
                                                    <th scope="col"style="width: 20%">Class ID</th>
                                                    <th scope="col"style="width: 25%">Attendance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php include 'Function/recordChildAttendance.php'; ?>
                                            </tbody>
                                        </table>
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
