<?php include '../Function/load.php';
$pageName = basename(__FILE__);
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<?php
include 'Function/editcourseschedule.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/XML/ParserFactory.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Objects/Course.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/InstructorDB.php';
?>
<?php
#Page Languages
$lang_title = "Edit existing course schedule";
$lang_description = "Edit an existing course schedule.";
$lang_required = "* Required Fields";
$lang_legendTitle = "Course Schedule Details";
?>
<html>
    <head>
<?php include 'Components/headmeta.php' ?>
        <script src="js/editcourseschedule.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="examinations.php">Course Schedule</a></li>
                        <li class="breadcrumb-item active">Edit Schedule</li>
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
                                                    <label for="scheduleID" class="col-form-label">Schedule ID <span class="required">*</span></label>
                                                    <input disabled type="text" class="bg-white form-control" id="scheduleID" name="scheduleID"
                                                           value="<?php echo empty($storedValue["scheduleID"]) ? "" : $storedValue["scheduleID"]; ?>"/>
                                                </div>
                                                <div class="col-md">
                                                    <label for="classID" class="col-form-label">Class ID <span class="required">*</span></label>
                                                    <input disabled type="text" class="bg-white form-control" id="classID" name="classID"
                                                           value="<?php echo empty($storedValue["classID"]) ? "" : $storedValue["classID"]; ?>"/>
                                                </div>
                                            </div>
                                            <br/>
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
                                                        $courses = $parser->getCourses();
                                                        foreach ($courses as $course) {
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
                                                            <option value="<?php echo $row->instructorID; ?>"><?php echo $row->instructorName; ?></option>
<?php } ?>
                                                    </datalist>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="dayOfWeek" class="col-form-label">Day of Week <span class="required">*</span></label>
                                                    <select name="dayOfWeek" id="dayOfWeek" width="100%" class="bg-white form-control form-select <?php echo empty($error["dayOfWeek"]) ? "" : "is-invalid"; ?>" placeholder="Select the day of week"
                                                             oninput="validateDayOfWeek()"/>
                                                        <option value="Monday" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Monday"?"selected":""); ?>>Monday</option>
                                                        <option value="Tuesday" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Tuesday"?"selected":""); ?>>Tuesday</option>
                                                        <option value="Wednesday" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Wednesday"?"selected":""); ?>>Wednesday</option>
                                                        <option value="Thursday" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Thursday"?"selected":""); ?>>Thursday</option>
                                                        <option value="Friday" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Friday"?"selected":""); ?>>Friday</option>
                                                        <option value="Saturday" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Saturday"?"selected":""); ?>>Saturday</option>
                                                        <option value="Sunday" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Sunday"?"selected":""); ?>>Sunday</option>
                                                    </select>
                                                    <span class="invalid-feedback"><?php echo empty($error["dayOfWeek"]) ? "" : $error["dayOfWeek"]; ?></span>

                                                </div>
                                                <div class="col-md">
                                                    <label for="classType" class="col-form-label">Class Type <span class="required">*</span></label>
                                                    <select name="classType" id="classType" width="100%" class="bg-white form-control form-select <?php echo empty($error["classType"]) ? "" : "is-invalid"; ?>" placeholder="Select the class type"
                                                             oninput="validateClassType()"/>
                                                        <option value="Lecture" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Lecture"?"selected":""); ?>>Lecture</option>
                                                        <option value="Tutorial" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Tutorial"?"selected":""); ?>>Tutorial</option>
                                                        <option value="Practical" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Practical"?"selected":""); ?>>Practical</option>
                                                        <option value="Blended" <?php echo empty($storedValue["dayOfWeek"]) ? "" : ($storedValue["instructor"]=="Blended"?"selected":""); ?>>Blended</option>
                                                    </select>
                                                    <span class="invalid-feedback"><?php echo empty($error["classType"]) ? "" : $error["classType"]; ?></span>

                                                </div>

                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="timeStart" class="col-form-label">Time Start <span class="required">*</span></label>
                                                    <input type="time" width="100%" placeholder="Enter the start time" class="bg-white form-control <?php echo empty($error["timeStart"]) ? "" : "is-invalid"; ?>" 
                                                           id="timeStart" name="timeStart" oninput="validateTimeStart()" value="<?php echo empty($storedValue["timeStart"]) ? "" : $storedValue["timeStart"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["timeStart"]) ? "" : $error["timeStart"]; ?></span>

                                                </div>
                                                <div class="col-md">
                                                    <label for="duration" class="col-form-label">Duration (in minutes)<span class="required">*</span></label>
                                                    <input type="number" min="1" max="6000" placeholder="Enter the duration" class="bg-white form-control <?php echo empty($error["duration"]) ? "" : "is-invalid"; ?>" 
                                                           id="duration" name="duration" oninput="validateDuration()" value="<?php echo empty($storedValue["duration"]) ? "" : $storedValue["duration"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["duration"]) ? "" : $error["duration"]; ?></span>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>
                                    <input hidden="true" name="formDetect" value="formDetect">
                                    <center>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                        <button type="button" class="btn btn-danger" onclick="location.href = 'courseschedule.php?id=<?php echo $storedValue["classID"]; ?>'">Cancel</button>
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
