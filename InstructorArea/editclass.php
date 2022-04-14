<?php include '../Function/load.php';$pageName = basename(__FILE__); ?>
<?php include 'Function/editclass.php';require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/InstructorDB.php'; ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->


<?php
#Page Languages
$lang_title = "Edit existing class";
$lang_description = "Edit an existing class.";
$lang_required = "* Required Fields";
$lang_legendTitle = "Class Details";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
        <script src="js/editclass.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="classes.php">Classes</a></li>
                        <li class="breadcrumb-item active">Edit Class</li>
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
                                                    <label for="semester" class="col-form-label">Semester <span class="required">*</span></label>
                                                    <input type="number" min="0" max="100" placeholder="Enter the semester" class="bg-white form-control <?php echo empty($error["semester"])?"":"is-invalid"; ?>" 
                                                           id="semester" name="semester" oninput="validateSemester()" value="<?php echo empty($storedValue["semester"])?"":$storedValue["semester"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["semester"])?"":$error["semester"]; ?></span>
                                                </div>
                                                <div class="col-md">
                                                    <label for="year" class="col-form-label">Year <span class="required">*</span></label>
                                                    <input type="number" min="2000" max="9999" placeholder="Enter the year" class="bg-white form-control <?php echo empty($error["year"])?"":"is-invalid"; ?>" 
                                                           id="year" name="year" oninput="validateYear()" value="<?php echo empty($storedValue["year"])?"":$storedValue["year"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["year"])?"":$error["year"]; ?></span>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="dateStart" class="col-form-label">Start Date <span class="required">*</span></label>
                                                    <input type="date" class="bg-white form-control <?php echo empty($error["dateStart"])?"":"is-invalid"; ?>" id="dateStart" name="dateStart" oninput="validateDateStart()" 
                                                           value="<?php echo empty($storedValue["dateStart"])?"":$storedValue["dateStart"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["dateStart"])?"":$error["dateStart"]; ?></span>
                                                </div>
                                                <div class="col-md">
                                                    <label for="dateEnd" class="col-form-label">End Date <span class="required">*</span></label>
                                                    <input type="date" class="bg-white form-control <?php echo empty($error["dateEnd"])?"":"is-invalid"; ?>" id="dateEnd" name="dateEnd" oninput="validateDateEnd()"
                                                            value="<?php echo empty($storedValue["dateEnd"])?"":$storedValue["dateEnd"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["dateEnd"])?"":$error["dateEnd"]; ?></span>
                                                </div>

                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="insturctor" class="col-form-label">Form Teacher <span class="required">*</span></label>
                                                    <input list="instructorList" type="text" placeholder="Enter the Instructor ID" class="bg-white form-control <?php echo empty($error["instructor"])?"":"is-invalid"; ?>" id="instructor" name="instructor" oninput="validateInstructor()" 
                                                           value="<?php echo empty($storedValue["instructor"])?"":$storedValue["instructor"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["instructor"])?"":$error["instructor"]; ?></span>
                                                    <datalist id="instructorList">
                                                        <?php 
                                                            $instructorDB = new InstructorDB();
                                                            $resultList = $instructorDB->list();
                                                            foreach($resultList as $row){
                                                        ?>
                                                        <option value="<?php echo $row->userID; ?>"><?php echo $row->name; ?></option>
                                                            <?php } ?>
                                                    </datalist>
                                                </div>
                                                <div class="col-md">
                                                    
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>
                                    <input hidden="true" name="formDetect" value="formDetect">
                                    <center>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                        <button type="button" class="btn btn-danger" onclick="location.href='classes.php'">Cancel</button>
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
