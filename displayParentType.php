<?php
include 'Function/load.php';
require_once './XML/ParentXSLT.php';
require_once './XML/ParentXPath.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
//Author: Tang Khai Li
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Parent Types</title>
        <?php include 'Components/headmeta.php'; ?>
        <?php include 'Components/ParentNavBar.php' ?>
    </head>
    <body>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="attendance.php">Child</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="">Display Parent Types</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Temperature
                    </li>
                </ol>
            </div>

            <section class="parent">
                <div class="container aos-init aos-animate" data-aos="fade-up">
                    <h2 class="text-center">Parent Types</h2>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-md">
                            <div class="row">
                                <div class="col-md">
                                    <?php
                                    if (!empty($_GET["levels"])) {
                                        ?>
                                        <h3>Display Types of Parents</h3>
                                        <?php
                                    }
                                    $parent = new ParentXSLT("XML/parent.xml", "XML/parent.xsl");
                                    //echo $temperature;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include "Components/footer.php"; ?>
    </body>
</html>
