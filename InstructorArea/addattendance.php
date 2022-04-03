<?php
include '../Function/load.php';
include 'Function/searchAttendance.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
@author Ng Kar Kai
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Attendance</title>
        <?php
        include './Components/headmeta.php';
        ?>
        <link rel="stylesheet" href="./css/addattendance.css" type="text/css">
        <script src="js/addattendance.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="addattendance.php">Attendance Log</a></li>
                    </ol>
                    <div class="container">
                        <?php
                        if (isset($_SESSION["attendanceExistError"])) {
                            $error["attendanceExistErr"] = $_SESSION["attendanceExistError"];
                            unset($_SESSION["attendanceExistError"]);
                        }
                        ?>
                        <div class="row">
                            <div class="col-md">
                                <br>
                                <h1 class="display-4">View Student Attendance</h1>
                                <p class="lead">View student attendances here </p>
                                <hr class="my-3">
                                <form method="POST" id="attendanceCreation" name="attendanceForm">
                                    <input type="hidden" name="prevPage" id="prevPage">
                                    <script>
                                        document.getElementById("prevPage").value = window.location.href;
                                    </script>
                                    <fieldset>
                                        <legend>
                                            Attendance Entry
                                        </legend>
                                        <div class="row">
                                            <div class="col-md">
                                                Date Today: <?php echo date("Y/m/d") . " " . date("l") ?>
                                                <input type="hidden" name="hiddenDate" value="<?php echo date("Y/m/d") ?>"/>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <select class="form-control bg-white small" name="searchCriteria" id="criteriaDropdown" onchange="searchBarConversion()">
                                                    <option value="name">Name </option>
                                                    <option value="date">Date</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="bg-white form-control 
                                                        <?php echo empty($error["emptySearch"])? "" : "is-invalid" ?><?php echo empty($error["attendanceExistErr"])?"":"is-invalid"?>" 
                                                           placeholder="Please enter the search criteria!" name="searchInfo" id="searchInfo">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-info" type="submit" name="submitBtn" value="searchBtn">Search</button>
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo empty($error["emptySearch"]) ? "" : $error['emptySearch'] ?> <?php echo empty($error["attendanceExistErr"]) ? "" : $error["attendanceExistErr"]?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="d-flex flex-row-reverse">
                                            <div class="p-2">
                                                <button type="button" class="btn btn-primary" onclick="downloadPDF()">Download to PDF</button>
                                            </div>
                                        </div>
                                        <!--Student Table to be injected here  -->
                                        <table class="table table-striped table-hover" id="attendanceTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 12%">Student ID</th>
                                                    <th scope="col"style="width: 20.6%">Name</th>
                                                    <th scope="col"style="width: 15.6%">Temperature</th>
                                                    <th scope="col"style="width: 16.6%"> Class ID</th>
                                                    <th scope="col"style="width: 17.6%">Date Taken</th>
                                                    <th scope="col"style="width: 17.6%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'Function/addAttendance.php'
                                                ?>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include 'Components/footer.php'
                ?>
            </div>
    </body>
</html>
