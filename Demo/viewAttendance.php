<?php
include 'Functions/searchAttendance.php'
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
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='author' content='$author'>
        <meta name='keywords' content='$keywords'>
        <meta name='description' content='$description'>
        <link rel='icon' type='image/x-icon' href='../images/favicon.png'>
        <title>Attendance List | Demo</title>
        <link href='../InstructorArea/css/main.css' rel='stylesheet' type='text/css'/>
        <link href='../InstructorArea/css/sb-admin-2.css' rel='stylesheet' type='text/css'/>
        <link href='../css/sweetalert2.min.css' rel='stylesheet' type='text/css'/>
        <script src='https://kit.fontawesome.com/3f628a0091.js' crossorigin='anonymous'></script>
        <script src='../js/jquery-3.6.0.js' type='text/javascript'></script>
        <script src='../js/sweetalert2.all.min.js' type='text/javascript'></script>
        <script src='../js/ckeditor.js' type='text/javascript'></script>
        <script src='../js/html2pdf.bundle.min.js' type='text/javascript'></script>
        <script src='../js/jquery.table2excel.js' type='text/javascript'></script>
        <script src='../InstructorArea/js/sb-admin-2.min.js' type='text/javascript'></script>
        <script src='../InstructorArea/js/main.js' type='text/javascript'></script>
        <script src='JavaScript/grades.js' type='text/javascript'></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="content-wrapper">
                <div id="content">
                    <div class="container-fluid">
                        <form method="POST" name="searchChildName">
                            <br/>
                            <br/>
                            <div class="row">
                                <div class="col-md">

                                    <div class="row justify-content-center">
                                        <div class="col-md">
                                            <h2>Attendance List</h2>
                                        </div>
                                        <div class="col-md">
                                            <div class="input-group mb-3">
                                                <input type="text" class="bg-white form-control 
                                                <?php echo empty($error["emptySearch"]) ? "" : "is-invalid" ?><?php echo empty($error["attendanceExistErr"]) ? "" : "is-invalid" ?>" 
                                                       placeholder="Please enter the child's name" name="searchInfo" id="searchInfo">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-info form-control" type="submit" name="searchBtn" value="searchBtn">Search</button>
                                                </div>
                                                <span class="invalid-feedback">
                                                    <?php echo empty($error["emptySearch"]) ? "" : $error['emptySearch'] ?> <?php echo empty($error["attendanceExistErr"]) ? "" : $error["attendanceExistErr"] ?>
                                                </span>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>

                            <br/>
                            <br/>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 25%" class="text-center">Attendance ID</th>
                                        <th scope="col"style="width: 25%" class="text-center">Child ID</th>
                                        <th scope="col"style="width: 25%" class="text-center">Temperature</th>
                                        <th scope="col"style="width: 25%" class="text-center"> Date Attended</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include 'Functions/viewAttendance.php' ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
