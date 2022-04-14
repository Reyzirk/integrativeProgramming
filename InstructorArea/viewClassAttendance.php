<?php
include '../Function/load.php';
include 'Function/searchClasses.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
//Author: Poh Choo Meng
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        include './Components/headmeta.php';
        ?>
        <title>Class Attendances</title>
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
                        <li class="breadcrumb-item active"><a href="addattendance.php">Class Attendance List</a></li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <br>
                                <h1 class="display-4">Class Attendance</h1>
                                <p class="lead">Select a class for attendance taking.</p>
                                <hr class="my-3">
                                <form method="POST" id="classAttendance" name="classAttendanceForm">
                                    <fieldset>
                                        <legend>
                                            Select a class for attendance taking
                                        </legend>
                                        <div class="row">
                                            <div class="col-md">
                                                Date Today: <?php echo date("Y/m/d") . " " . date("l") ?>
                                                <input type="hidden" name="hiddenDate" value="<?php echo date("Y/m/d") ?>"/>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-9">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="bg-white form-control <?php echo empty($error["emptySearch"]) || empty($error["attendanceExistErr"]) ? "" : "is-invalid" ?>" placeholder="Enter class ID here..." name="searchInfo" id="searchInfo">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-info" type="submit" name="submitBtn" value="searchBtn">Search</button>
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo empty($error["emptySearch"]) ? "" : $error["emptySearch"] ?> <?php echo empty($error["attendanceExistErr"]) ? "" : $error["attendanceExistErr"] ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <table class="table table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" style="width: 30%">Class ID</th>
                                                    <th scope="col"style="width: 25%">Semester</th>
                                                    <th scope="col"style="width: 25%">Year</th>
                                                    <th scope="col"style="width: 20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php include 'Function/viewClassAttendance.php' ?>
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
