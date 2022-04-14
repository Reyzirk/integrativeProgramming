<?php
include 'Function/load.php';
require_once "Database/AnnouncementDB.php";
require_once "Function/announcement.php";
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
//Author: Oon Kheng Huang
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Announcement</title>
        <?php include 'Components/headmeta.php'; ?>
        <link rel="stylesheet" href="css/announcement.css" />
    </head>
    <body>
        <?php include 'Components/ParentNavBar.php';callLog(); ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                </ol>

            </div>
            <section class="course">
                <div class="container aos-init aos-animate" data-aos="fade-up">
                    <h2 class="text-center">Announcement List</h2>
                    <div class="row" style="margin-top: 30px">
                        <form name="searchBox" method="POST">
                            <center>
                                <div class="col-md-5">   
                                    <div class="input-group">

                                        <input type="text" name="inputSearch" id="inputSearch" placeholder="Search by (Title/ID/Date/Description)" title="search" class="form-control bg-white small"/>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" runat="server" id="searchButton" onclick="form.submit()">
                                                <i class="fas fa-search fa-sm"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </div>  
                            </center>
                        </form>  

                    </div>
                    <div class="row" style="margin-top: 30px">
                        <?php $announceDB = new AnnouncementDB(); ?>

                        <div class="col-md-3">
                            <div class="shadow announceLeftBar">    
                                <h5 class="text-center"><b>&#x1F4CC; Pinned Announcement</b></h5>
                                <hr/>
                                <?php
                                if (($announceDB->hasPinTop()) != 0) {
                                    ?>
                                    <div onclick="location.href = 'viewannouncement.php?id=<?php echo $pinAnnounce->announceID ?>'" style="cursor:pointer">
                                        <div>
                                            Date: <?php echo $pinAnnounce->date ?>
                                        </div>
                                        <div>
                                            Category: <?php echo convertCatToWord($pinAnnounce->cat) ?>
                                        </div>
                                        <div class="itemTitle"><?php echo $pinAnnounce->title ?></div>
                                        <div style="word-break: break-word">
                                            <p class="breakLine"><?php echo html_entity_decode($pinAnnounce->desc) ?></p> 
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="itemTitle" style="text-align: center">
                                        No Pinned Announcement...
                                    </div> 


                                <?php } ?>


                            </div>


                        </div>
                        <div class="col-md-9">
                            <?php
                            $readDB = new ReadStatusDB();
                            if (!empty($results)) {
                                foreach ($results as $row) {
                                    ?>
                                    <div class="shadow announceItem" onclick="location.href = 'viewannouncement.php?id=<?php echo $row->announceID ?>'" >
                                        <div class="row">
                                            <div class="col-md-7">
                                                <span class="itemTitle"><?php echo $row->title ?></span>
                                            </div>
                                            <div class="col-md-1" style="margin: auto">
                                                <?php
                                                $read = new ReadStatus($row->announceID, $parentID);
                                                if ($readDB->checkExist($read)) {
                                                    ?>
                                                    <div class="readStatusRead">Read</div>
                                                <?php } else {
                                                    ?>
                                                    <div class="readStatus">New</div>
                                                <?php } ?>

                                            </div>
                                            <div class="col-md-2" style="margin: auto">
                                                <?php echo convertCatToWord($row->cat) ?>
                                            </div>
                                            <div class="col-md-2" style="margin: auto">

                                                <?php echo $row->date ?>

                                            </div>
                                        </div>




                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<center><h3>No result found...</h3></center>";
                            }
                            ?>

                        </div>

                    </div>
                </div><br/><br/>
            </section>
            <?php include "Components/footer.php"; ?>

        </div>
    </body>
</html>
