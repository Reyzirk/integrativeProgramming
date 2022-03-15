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
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <h1 class="display-4">Update Student Attendance</h1>
                    <p class="lead">Update student attendances here <span class="reqF">* Required Fields</span></p>
                    <hr class="my-3">
                    <form method="POST" id="attendanceCreation" enctype="multipart/form-data">
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
                                <div class="col-sm-3">
                                    <select class="form-control bg-white small">
                                        <option value="name">Name </option>
                                        <option value="class">Class</option>
                                    </select>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="bg-white form-control" placeholder="Please enter the search criteria!">
                                </div>
                            </div>
                            <!--Student Table to be injected here  -->
                            
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
