<?php
include '../Function/load.php';
$pageName = basename(__FILE__);
include 'Function/viewexamination.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
//Author: Poh Choo Meng
-->

<?php
#Page Languages
$lang_title = "View existing examination";
$lang_description = "View an existing examination.";
$lang_required = "";
$lang_legendTitle = "Examination Details";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="announcement.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="examinations.php">Examinations</a></li>
                        <li class="breadcrumb-item active">View Examination</li>
                    </ol>
                    <div class="container-fluid">
                        <div id="formControl">
                            <div class="jumbotrun" id="container">
                                <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                <p class="lead"><?php echo $lang_description; ?> <span class="required"><?php echo $lang_required; ?></span></p>
                                <hr class="my-3">
                                <div class="form-group">
                                    <fieldset>
                                        <legend><?php echo $lang_legendTitle; ?></legend>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="examinationID" class="col-form-label">Examination ID </label>
                                                <p class="p-12 font-weight-bold"><?php echo $retrievedExam->examinationID; ?></p>

                                            </div>
                                            <div class="col-md">
                                                <label for="courseName" class="col-form-label">Examination Time</label>
                                                <p class="p-12 font-weight-bold"><?php echo $retrievedExam->examStartTime; ?> - <?php echo $endtime->format('Y-m-d H:i:s'); ?>
                                                <br/>
                                                <?php echo convertMinute($retrievedExam->examDuration); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="course" class="col-form-label">Course</label>
                                                <p class="p-12 font-weight-bold"><?php echo $retrievedExam->course; ?>
                                                <br/>
                                                <?php echo $retrievedCourse->courseName; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="instructor" class="col-form-label">Instructor</label>
                                                <p class="p-12 font-weight-bold"><?php echo $retrievedInstructor->name; ?>(<?php echo $retrievedExam->examiner; ?>)</p>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <input hidden="true" name="formDetect" value="formDetect">
                                <center>
                                    <button type="button" class="btn btn-warning" id="submitBtn" onclick="location.href='editexamination.php?id=<?php echo $id; ?>'">Modify</button>
                                    <button type="button" class="btn btn-danger" onclick="location.href = 'examinations.php'">Cancel</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
    </body>
</html>
