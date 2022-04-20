<?php
include 'Function/load.php';
require_once './XML/AttendanceXSLT.php';
require_once './XML/AttendanceXPath.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
//Author: Ng Kar Kai
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Temperature Levels</title>
        <?php include 'Components/headmeta.php'; ?>
        <?php include 'Components/ParentNavBar.php' ?>
    </head>
    <body>
        <div id="content">

            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="attendance.php">Attendance</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="">Covid-19</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Temperature
                    </li>
                </ol>
            </div>

            <section class="course">
                <div class="container aos-init aos-animate" data-aos="fade-up">
                    <h2 class="text-center">Temperature Levels</h2>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-md">
                            <?php
                            if (!empty($_GET["levels"])) {
                                $temperatureXPath = new AttendanceXPath("XML/attendance.xml");
                                $levels = trim($_GET["levels"]);
                                $code = "/attendance/childTemperature[@temperature ='" . $levels . "']/code/text()";
                                $desc = "/attendance/childTemperature[@temperature ='" . $levels . "']/description/text()";
                                ?>
                                <span style="font-size: 15pt">
                                    <b>Code: </b><?php echo $temperatureXPath->display($code) ?>
                                    <br/>
                                    <b>Description: </b><?php echo $temperatureXPath->display($desc) ?>
                                    <br/>
                                    <hr/>
                                    <br/>
                                </span>
                            <?php }
                            else{
                                ?>
                                    <span style="font-size: 15pt">
                                    <b>Code: </b>No matching criteria found.
                                    <br/>
                                    <b>Description: </b>No matching criteria found.
                                    <br/>
                                    <hr/>
                                    <br/>
                                </span>
                                    <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <?php
                            if (!empty($_GET["levels"])) {
                                ?>
                                <h3>General guidance of temperature levels </h3>
                                <?php
                                }
                                $temperature = new AttendanceXSLT("XML/attendance.xml", "XML/attendance.xsl");
                                //echo $temperature;
                                ?>
                            </div>
                        </div>
                </div>
                </section>

            </div>
    <?php include "Components/footer.php"; ?>
    </body>
</html>
