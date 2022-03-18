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
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <br>
                                <h1 class="display-4">Update Student Attendance</h1>
                                <p class="lead">Update student attendances here </p>
                                <hr class="my-3">
                                <form method="POST" id="attendanceCreation" name="attendanceForm">
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
                                                <select class="form-control bg-white small" name="searchCriteria">
                                                    <option value="name">Name </option>
                                                    <option value="class">Class</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="bg-white form-control" placeholder="Please enter the search criteria!" name="searchInfo">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-info" type="submit" name="submit">Search</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <span class="invalid-feedback"><?php echo empty($error["emptySearch"]) ? "123" : $error['emptySearch'] ?></span>
                                        </div>
                                        <br><br>
                                        <!--Student Table to be injected here  -->
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Student ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Temperature</th>
                                                    <th scope="col" class="w-25">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'Function/addAttendance.php'
                                                ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    include 'Components/footer.php'
                    ?>
                </div>
            </div>
    </body>
</html>
