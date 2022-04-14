<?php include 'Function/load.php';require_once "Database/ChildClassDB.php";include 'Function/viewexamination.php'; ?>
<?php $childID = $_SESSION["childID"]; ?>
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
        <?php include 'Components/headmeta.php'; ?>
        <script src="js/homeworks.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                    <li class="breadcrumb-item"><a href="examinations.php?id=<?php echo $classID; ?>">Examinations</a></li>
                    <li class="breadcrumb-item active">View Examination</li>
                </ol>
                
            </div>
            <div class="container">
                <div class="alert alert-dismissible alert-danger">
                    Do you want switch to another child?  <a href="selectchild.php?transferpath=homework" class="alert-link">Switch Child</a>
                </div>
            </div>
            
            <section id="classes" class="classes">
                
                <div class="container">
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
                                            <p class="p-12 font-weight-bold"><b><?php echo $retrievedExam->examinationID; ?></b></p>

                                        </div>
                                        <div class="col-md">
                                            <label for="courseName" class="col-form-label">Examination Time</label>
                                            <p class="p-12 font-weight-bold"><b><?php echo $retrievedExam->examStartTime; ?> - <?php echo $endtime->format('Y-m-d H:i:s'); ?>
                                            <br/>
                                            <?php echo convertMinute($retrievedExam->examDuration); ?>
                                            </b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="course" class="col-form-label">Course</label>
                                            <p class="p-12 font-weight-bold"><b><?php echo $retrievedExam->course; ?>
                                            <br/>
                                            <?php echo $retrievedCourse->courseName; ?></b></p>
                                        </div>
                                        <div class="col-md">
                                            <label for="mark" class="col-form-label">Marks</label>
                                            <p class="p-12 font-weight-bold"><b><?php echo ($mark==-1?"NA":$mark); ?><br/>[<?php echo $gradeResult; ?>]</b></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="instructor" class="col-form-label">Instructor</label>
                                            <p class="p-12 font-weight-bold"><b><?php echo $retrievedInstructor->name; ?>(<?php echo $retrievedExam->examiner; ?>)</b></p>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <input hidden="true" name="formDetect" value="formDetect">
                            <center>
                                <button type="button" class="btn btn-danger" onclick="location.href = 'examinations.php?id=<?php echo $classID; ?>'">Cancel</button>
                            </center>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <br/>
        <?php include 'Components/footer.php' ?>
    </body>
</html>
