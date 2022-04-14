<?php include '../Function/load.php';$pageName = basename(__FILE__); ?>
<?php include 'Function/creategrade.php' ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
Author: Poh Choo Meng
-->


<?php
#Page Languages
$lang_title = "Create new grade";
$lang_description = "Create a new grade.";
$lang_required = "* Required Fields";
$lang_legendTitle = "Grade Details";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
        <script src="js/creategrade.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="grades.php">Grades</a></li>
                        <li class="breadcrumb-item active">Create Grade</li>
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
                                                    <label for="grade" class="col-form-label">Grade <span class="required">*</span></label>
                                                    <input type="text" maxlength="3" placeholder="Enter the grade" class="bg-white form-control <?php echo empty($error["grade"])?"":"is-invalid"; ?>" 
                                                           id="grade" name="grade" oninput="validateGrade()" value="<?php echo empty($storedValue["grade"])?"":$storedValue["grade"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["grade"])?"":$error["grade"]; ?></span>
                                                </div>
                                                <div class="col-md"></div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="minMark" class="col-form-label">Min Mark <span class="required">*</span></label>
                                                    <input type="number" min="0" max="100" class="bg-white form-control <?php echo empty($error["minMark"])?"":"is-invalid"; ?>" id="minMark" name="minMark" oninput="validateMinMark()" 
                                                           value="<?php echo empty($storedValue["minMark"])?"":$storedValue["minMark"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["minMark"])?"":$error["minMark"]; ?></span>
                                                </div>
                                                <div class="col-md">
                                                    <label for="maxMark" class="col-form-label">Max Mark <span class="required">*</span></label>
                                                    <input type="number" min="0" max="100" class="bg-white form-control <?php echo empty($error["maxMark"])?"":"is-invalid"; ?>" id="maxMark" name="maxMark" oninput="validateMaxMark()"
                                                            value="<?php echo empty($storedValue["maxMark"])?"":$storedValue["maxMark"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["maxMark"])?"":$error["maxMark"]; ?></span>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>
                                    <input hidden="true" name="formDetect" value="formDetect">
                                    <center>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                        <button type="button" class="btn btn-warning" onclick="location.href='creategrade.php'">Reset</button>
                                        <button type="button" class="btn btn-danger" onclick="location.href='grades.php'">Cancel</button>
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
