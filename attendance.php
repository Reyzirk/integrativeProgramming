<?php
include 'Function/load.php';
$parentID = $_SESSION["parentID"];
//$parentID = "P002";
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
        <?php
        include './Components/headmeta.php';
        ?>
        <?php
        include './Components/ParentNavBar.php';
        ?>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="wrapper">
            <div id="content-wrapper">
                <div id ="content">
                    <div class="breadcrumbs shadow container">
                        <ol class="breadcrumb" id="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="announcement.php">Announcement</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Child Attendance Record
                            </li>
                        </ol>
                    </div>

                    <div class="container">
                        <div id="displayList">
                            <div class="jumbotron" id="container">
                                <h2 class="text-center">Attendance List</h2>
                                <br>
                                <div class="rightSide">
                                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search text-center m-auto searchDiv">
                                        <div class="input-group">
                                            <input type="text" name="inputSearch" id="inputSearch" placeholder="Search for a record" title="Enter search criteria" class="form-control bg-white small"/>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" runat="server" id="searchButton" name="submitBtn" value="search" onclick="">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <br/>
                                <table class="table table-hover" id="">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 12%">Student ID</th>
                                            <th scope="col"style="width: 20.6%">Name</th>
                                            <th scope="col"style="width: 15.6%">Temperature</th>
                                            <th scope="col"style="width: 16.6%"> Class ID</th>
                                            <th scope="col"style="width: 17.6%">Date Taken</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'Function/attendance.php';
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "Components/footer.php"; ?>
    </body>
</html>
