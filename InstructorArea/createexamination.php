<?php include '../Function/load.php';
$pageName = basename(__FILE__);
include 'Function/createexamination.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<?php

require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/XML/ParserFactory.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Objects/Course.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/InstructorDB.php';
?>
<?php
#Page Languages
$lang_title = "Create new examination";
$lang_description = "Create a new examination.";
$lang_required = "* Required Fields";
$lang_legendTitle = "Examination Details";
?>
<html>
    <head>
<?php include 'Components/headmeta.php' ?>
        <script src="js/createexamination.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="examinations.php">Examinations</a></li>
                        <li class="breadcrumb-item active">Create Examination</li>
                    </ol>
                    <div class="container-fluid">
                        <div id="formControl">
                            <div class="jumbotrun" id="container">
                                <form method="POST" id="form" name="form">
                                    <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                    <p class="lead"><?php echo $lang_description; ?> <span class="required"><?php echo $lang_required; ?></span></p>
                                    <hr class="my-3">
                                    <div class="form-group">
                                        <fieldset>
                                            <legend><?php echo $lang_legendTitle; ?></legend>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="courseCode" class="col-form-label">Course Code <span class="required">*</span></label>
                                                    <input list="courseList" type="text" maxlength="10" placeholder="Enter the Course Code" class="bg-white form-control <?php echo empty($error["courseCode"]) ? "" : "is-invalid"; ?>" id="courseCode" name="courseCode" oninput="validateCourseCode()" 
                                                           value="<?php echo empty($storedValue["courseCode"]) ? "" : $storedValue["courseCode"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["courseCode"]) ? "" : $error["courseCode"]; ?></span>
                                                    <datalist id="courseList">
                                                        <?php
                                                        $factory = new ParserFactory();
                                                        $parser = $factory->getParser("Courses");
                                                        while($course = $parser->getCourses()->next()){
                                                            ?>
                                                            <option value="<?php echo $course->courseCode; ?>"><?php echo $course->courseName; ?></option>
                                                        <?php } ?>
                                                    </datalist>
                                                </div>
                                                <div class="col-md">
                                                    <label for="insturctor" class="col-form-label">Examiner <span class="required">*</span></label>
                                                    <input list="instructorList" type="text" placeholder="Enter the Instructor ID" class="bg-white form-control <?php echo empty($error["instructor"]) ? "" : "is-invalid"; ?>" id="instructor" name="instructor" oninput="validateInstructor()" 
                                                           value="<?php echo empty($storedValue["instructor"]) ? "" : $storedValue["instructor"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["instructor"]) ? "" : $error["instructor"]; ?></span>
                                                    <datalist id="instructorList">
                                                        <?php
                                                        $instructorDB = new InstructorDB();
                                                        $resultList = $instructorDB->list();
                                                        foreach ($resultList as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->userID; ?>"><?php echo $row->name; ?></option>
                                                            <?php } ?>
                                                    </datalist>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="examStartTime" class="col-form-label">Exam Start Time <span class="required">*</span></label>
                                                    <input type="datetime-local" width="100%" placeholder="Enter the exam start time" class="bg-white form-control <?php echo empty($error["examStartTime"]) ? "" : "is-invalid"; ?>" 
                                                           id="examStartTime" name="examStartTime" oninput="validateExamStartTime()" value="<?php echo empty($storedValue["examStartTime"]) ? "" : $storedValue["examStartTime"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["examStartTime"]) ? "" : $error["examStartTime"]; ?></span>

                                                </div>
                                                <div class="col-md">
                                                    <label for="examDuration" class="col-form-label">Exam Duration (in minutes)<span class="required">*</span></label>
                                                    <input type="number" min="1" max="60000" placeholder="Enter the exam duration" class="bg-white form-control <?php echo empty($error["examDuration"]) ? "" : "is-invalid"; ?>" 
                                                           id="examDuration" name="examDuration" oninput="validateExamDuration()" value="<?php echo empty($storedValue["examDuration"]) ? "" : $storedValue["examDuration"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["examDuration"]) ? "" : $error["examDuration"]; ?></span>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>
                                    <input hidden="true" name="formDetect" value="formDetect">
                                    <center>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                        <button type="button" class="btn btn-warning" onclick="location.href = 'createexamination.php'">Reset</button>
                                        <button type="button" class="btn btn-danger" onclick="location.href = 'examinations.php'">Cancel</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
    </body>
</html>
