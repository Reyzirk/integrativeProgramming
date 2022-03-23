<?php
include '../Function/load.php';
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
                                <p class="lead">Take children attendances here..</p>
                                <hr class="my-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
