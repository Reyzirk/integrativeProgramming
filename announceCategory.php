<?php
include 'Function/load.php';
require_once './XML/AnnouncementXSLT.php';
require_once './XML/AnnouncementXPath.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================

@author Oon Kheng Huang
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php include 'Components/headmeta.php'; ?>
        <?php include 'Components/ParentNavBar.php' ?>
    </head>
    <body>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="announcement.php">Announcement</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Announcement Category
                    </li>
                </ol>

            </div>
            <section class="course">
                <div class="container aos-init aos-animate" data-aos="fade-up">
                    <h2 class="text-center">Announcement Category</h2>
                    <div class="row" style="margin-top: 30px">
                        <div class="col-md">
                            <?php
                            if (!empty($_GET["cat"])) {
                                $announceXpath = new AnnouncementXPath("XML/announcement.xml");
                                $cat = trim($_GET["cat"]);
                                $expr1 = "/announcement/category[@catID='" . $cat . "']/name/text()";
                                $expr2 = "/announcement/category[@catID='" . $cat . "']/description/text()";
                                ?>
                                <!--********************Announcement XPath implementation*********************-->
                                <span style="font-size: 15pt">
                                    <b>Category: </b><?php echo $announceXpath->display($expr1) ?><br/>
                                    <b>Description: </b><?php echo $announceXpath->display($expr2) ?><br/><hr/><br/>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <?php
                            if (!empty($_GET["cat"])) {
                                ?>
                                <h4>Other announcement details:</h4>
                            <?php } ?>
                                <!--********************Announcement XSLT implementation*********************-->
                            <?php
                            $announce = new AnnouncementXSLT("XML/announcement.xml", "XML/announcement.xsl");
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div><br/><br/>

        <?php include "Components/footer.php"; ?>
    </body>
</html>
