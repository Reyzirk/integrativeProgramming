<?php include '../Function/load.php';$pageName = basename(__FILE__); ?>
<?php include 'Function/createholiday.php'; ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->


<?php
#Page Languages
$lang_title = "Create new holiday";
$lang_description = "Create a new holiday.";
$lang_required = "* Required Fields";
$lang_legendTitle = "Holiday Details";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
        <script src="js/createholiday.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="holidays.php">Holidays</a></li>
                        <li class="breadcrumb-item active">Create Holiday</li>
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
                                        </fieldset>
                                    </div>
                                    <input hidden="true" name="formDetect" value="formDetect">
                                    <center>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                        <button type="button" class="btn btn-warning" onclick="location.href='createholiday.php'">Reset</button>
                                        <button type="button" class="btn btn-danger" onclick="location.href='holidays.php'">Cancel</button>
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
