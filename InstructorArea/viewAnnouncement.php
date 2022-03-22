<?php
include '../Function/load.php';
$pageName = basename(__FILE__);
include './Function/viewAnnouncement.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================

@author Oon Kheng Huang
-->

<?php
#Page Languages
$lang_title = "View announcement";
$lang_description = "View an existing announcement.";
$lang_legendTitle = "Announcement Details";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Announcement</title>
        <?php
        include './Components/headmeta.php';
        ?>
        <script src="js/createAnnouncement.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                        <li class="breadcrumb-item active">View Announcement</li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div id="formControl">
                                    <div class="jumbotrun" id="container">
                                        <form method="POST" id="form" name="form">
                                            <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                            <p class="lead"><?php echo $lang_description; ?> </p>
                                            <hr class="my-3">
                                            <div class="form-group">
                                                <fieldset>
                                                    <legend><?php echo $lang_legendTitle; ?></legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="class" class="col-form-label font-weight-bold">Announcement ID</label>
                                                            <p class="p-12"><?php echo $announceInfo->announceID; ?></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="cat" class="col-form-label font-weight-bold">Category</label>
                                                            <p class="p-12"><?php echo convertCatToWord($announceInfo->cat); ?></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="date" class="col-form-label font-weight-bold">Date</label>
                                                            <p class="p-12"><?php echo $announceInfo->date; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label for="class" class="col-form-label font-weight-bold">Title</label>
                                                            <div style=" background-color: white; border-radius: 15px;box-shadow: 0px 5px 5px  rgba(51, 51, 51, 0.3);">
                                                                <p class="p-12"><span style="font-size: 20pt;padding-left:10px"><?php echo $announceInfo->title; ?></span></p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label for="class" class="col-form-label font-weight-bold">Description</label>
                                                            <div style=" background-color: white; border-radius: 15px;box-shadow: 0px 5px 5px  rgba(51, 51, 51, 0.3); min-height: 100px">
                                                                <div style="padding: 15px;"><span style="background-color: white;">
                                                                        <?php
                                                                        //*************Implementation of AnnounceDecorator
                                                                        $parent = new InstructorsAnnounceDecorator($announceInfo);
                                                                        echo html_entity_decode($parent->getAnnounceDesc());
                                                                        ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <?php if (!($announceInfo instanceof AnnounceWithNoAttach)) { ?>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <h5>Attachments</h5>
                                                                <hr/>
                                                                <?php
                                                                if ($announceInfo instanceof AnnounceWithImg) {
                                                                    $attach = $announceInfo->attach;

                                                                    foreach ($attach as $row) {
                                                                        ?>

                                                                        <a href="..<?php echo $row->filePath; ?>" target="_blank"><img src="..<?php echo $row->filePath ?>" width="auto" height="300" style="padding-right: 10px" /></a>

                                                                        <?php
                                                                    }
                                                                } else if ($announceInfo instanceof AnnounceWithImgDoc) {
                                                                    $img = array();
                                                                    $doc = array();
                                                                    $docName = array();
                                                                    $attach = $announceInfo->attach;
                                                                    foreach ($attach as $row) {

                                                                        $path = pathinfo($row->attachName, PATHINFO_EXTENSION);

                                                                        if ($path != "png" && $path != "jpeg" && $path != "svg" && $path != "jpg" && $path != "gif") {
                                                                            $doc[] = $row->filePath;
                                                                            $docName[] = $row->attachName;
                                                                        } else {
                                                                            $img[] = $row->filePath;
                                                                        }
                                                                    }
                                                                    foreach ($img as $row) {
                                                                        ?>
                                                                        <a href="..<?php echo $row; ?>" target="_blank"><img src="..<?php echo $row ?>" width="auto" height="300" style="padding-right: 10px" /></a>    

                                                                        <?php
                                                                    }
                                                                    echo "<br/><br/>";
                                                                    $i = 0;
                                                                    foreach ($doc as $row) {
                                                                        ?>
                                                                        <img src="../images/docIcon.gif" width="20px" height="20px" /><a href="..<?php echo $row ?>" target="_blank"><?php echo $docName[$i] ?></a><br/>
                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                } else {
                                                                    $attach = $announceInfo->attach;
                                                                    foreach ($attach as $row) {
                                                                        ?>
                                                                        <img src="../images/docIcon.gif" width="20px" height="20px" /><a href="..<?php echo $row->filePath ?>" target="_blank"><?php echo $row->attachName ?></a><br/>

                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </div>

                                                        </div>
                                                        <br/>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <h5>Comment</h5>
                                                            <hr/>

                                                        </div>

                                                    </div>
                                                </fieldset>
                                            </div>
                                            <input hidden="true" name="formDetect" value="formDetect">
                                            <center>
                                                <button type="button" class="btn btn-warning" id="submitBtn" onclick="location.href = 'editAnnouncement.php?aID=<?php echo $id; ?>'">Modify</button>
                                                <button type="button" class="btn btn-danger" onclick="location.href = 'announcement.php'">Back</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
    </body>
</html>
