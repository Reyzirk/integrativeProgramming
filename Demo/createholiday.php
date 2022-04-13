<?php include 'createholidaybackend.php'; ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->


<?php
//Author: Poh Choo Meng
#Page Languages
$lang_title = "Create new holiday";
$lang_description = "Create a new holiday.";
$lang_required = "* Required Fields";
$lang_legendTitle = "Holiday Details";
?>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='author' content='$author'>
        <meta name='keywords' content='$keywords'>
        <meta name='description' content='$description'>
        <link rel='icon' type='image/x-icon' href='../images/favicon.png'>
        <title>Create Holiday | Demo Section</title>
        <link href='../InstructorArea/css/main.css' rel='stylesheet' type='text/css'/>
        <link href='../InstructorArea/css/sb-admin-2.css' rel='stylesheet' type='text/css'/>
        <link href='../css/sweetalert2.min.css' rel='stylesheet' type='text/css'/>
        <script src='https://kit.fontawesome.com/3f628a0091.js' crossorigin='anonymous'></script>
        <script src='../js/jquery-3.6.0.js' type='text/javascript'></script>
        <script src='../js/sweetalert2.all.min.js' type='text/javascript'></script>
        <script src='../js/ckeditor.js' type='text/javascript'></script>
        <script src='../js/html2pdf.bundle.min.js' type='text/javascript'></script>
        <script src='../js/jquery.table2excel.js' type='text/javascript'></script>
        <script src='../InstructorArea/js/sb-admin-2.min.js' type='text/javascript'></script>
        <script src='../InstructorArea/js/main.js' type='text/javascript'></script>
        <script src='JavaScript/createholiday.js' type='text/javascript'></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="content-wrapper">
                <div id="content">
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
                                                    <label for="holidayName" class="col-form-label">Holiday Name <span class="required">*</span></label>
                                                    <input type="text" maxlength="300" placeholder="Enter the holiday name" class="bg-white form-control <?php echo empty($error["holidayName"])?"":"is-invalid"; ?>" 
                                                           id="holidayName" name="holidayName" oninput="validateHolidayName()" value="<?php echo empty($storedValue["holidayName"])?"":$storedValue["holidayName"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["holidayName"])?"":$error["holidayName"]; ?></span>
                                                </div>
                                                <div class="col-md"></div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="dateStart" class="col-form-label">Start Date <span class="required">*</span></label>
                                                    <input type="date" class="bg-white form-control <?php echo empty($error["dateStart"])?"":"is-invalid"; ?>" max="<?php echo empty($storedValue["dateEnd"])?"":$storedValue["dateEnd"]; ?>" id="dateStart" name="dateStart" oninput="validateDateStart()" 
                                                           value="<?php echo empty($storedValue["dateStart"])?"":$storedValue["dateStart"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["dateStart"])?"":$error["dateStart"]; ?></span>
                                                </div>
                                                <div class="col-md">
                                                    <label for="dateEnd" class="col-form-label">End Date <span class="required">*</span></label>
                                                    <input type="date" class="bg-white form-control <?php echo empty($error["dateEnd"])?"":"is-invalid"; ?>" min="<?php echo empty($storedValue["dateStart"])?"":$storedValue["dateStart"]; ?>" id="dateEnd" name="dateEnd" oninput="validateDateEnd()"
                                                            value="<?php echo empty($storedValue["dateEnd"])?"":$storedValue["dateEnd"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["dateEnd"])?"":$error["dateEnd"]; ?></span>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>
                                    <input hidden="true" name="formDetect" value="formDetect">
                                    <center>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                        <button type="button" class="btn btn-warning" onclick="location.href='createholiday.php'">Reset</button>
                                        <button type="button" class="btn btn-danger" onclick="location.href='holidaylist.php'">Cancel</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
