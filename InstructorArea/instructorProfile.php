<?php
include '../Function/load.php';$pageName = basename(__FILE__); 
include './Function/instructorProfile.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        include './Components/headmeta.php';
        ?>
        <style>
            .requiredF{
                color:red;
                font-size:12pt;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Instructor Profile</li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <div id="displayList">
                                <div class="jumbotrun" id="container">
                                    <form method="POST" id="formSubmit" name="formSubmit">
                                    <h1 class="display-4">Instructor Profile</h1>
                                    <p class="lead">Instructor Profile Details</p>
                                    <hr class="my-3">
                                    <fieldset>
                                        <legend>Details</legend>
                                        <!--************************Instructor ID and Employ Date***************************-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="instructID" class="col-form-label">Instructor ID</label>
                                                <input id="instructID" readonly type="text" name="instructID" class="bg-white form-control" value="<?php echo empty($storedValue["instructID"]) ? "" : $storedValue["instructID"]; ?>"/>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="employDate" class="col-form-label">Date of employment</label>
                                                <input id="employDate" readonly type="date" name="employDate" class="bg-white form-control" value="<?php echo empty($storedValue["employDate"]) ? "" : $storedValue["employDate"]; ?>"/>
                                            </div>
                                        </div><br/>
                                        <!--************************Ic No and Birth date***************************-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="icNo" class="col-form-label">IC No</label>
                                                <input id="icNo" readonly type="text" name="icNo" class="bg-white form-control" value="<?php echo empty($storedValue["icNo"]) ? "" : $storedValue["icNo"]; ?>"/>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="birthDate" class="col-form-label">Birth Date</label>
                                                <input id="birthDate" readonly type="date" name="birthDate" class="bg-white form-control" value="<?php echo empty($storedValue["birthDate"]) ? "" : $storedValue["birthDate"]; ?>"/>
                                            </div>
                                        </div><br/>
                                        <!--************************Name***************************-->
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="name" class="col-form-label">Name <span class="requiredF">*</span></label>
                                                <input id="name" type="text" name="name" class="bg-white form-control <?php echo empty($error["name"]) ? "" : "is-invalid"; ?>" placeholder="Please enter name" 
                                                       maxlength="300" value="<?php echo empty($storedValue["name"]) ? "" : $storedValue["name"]; ?>"/>
                                                <span class="invalid-feedback"><?php echo empty($error["name"]) ? "" : $error["name"]; ?></span>
                                            </div>
                                        </div><br/>
                                        <!--************************Email***************************-->
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="email" class="col-form-label">Email <span class="requiredF">*</span></label>
                                                <input id="email" type="text" name="email" class="bg-white form-control <?php echo empty($error["email"]) ? "" : "is-invalid"; ?>" placeholder="Please enter email" 
                                                       maxlength="320" value="<?php echo empty($storedValue["email"]) ? "" : $storedValue["email"]; ?>"/>
                                                <span class="invalid-feedback"><?php echo empty($error["email"]) ? "" : $error["email"]; ?></span>
                                            </div>
                                        </div><br/>
                                        <!--************************Gender & Contact Number***************************-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="gender" class="col-form-label">Gender <span class="requiredF">*</span></label>
                                                <select id="gender" name="gender" class="bg-white form-control <?php echo empty($error["gender"]) ? "" : "is-invalid"; ?>">
                                                    <option selected value="">-Select-</option>
                                                    <option value="M" <?php echo empty($storedValue["gender"]) ? "" : (($storedValue["gender"] == "M") ? "selected" : ""); ?>>Male</option>
                                                    <option value="F" <?php echo empty($storedValue["gender"]) ? "" : (($storedValue["gender"] == "F") ? "selected" : ""); ?>>Female</option>                                               
                                                </select>
                                                <span class="invalid-feedback"><?php echo empty($error["gender"]) ? "" : $error["gender"]; ?></span>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="contact" class="col-form-label">Contact Number <span class="requiredF">*</span></label>
                                                <input id="contact" type="text" name="contact" class="bg-white form-control <?php echo empty($error["contact"]) ? "" : "is-invalid"; ?>" placeholder="Please enter contact number without '-'" 
                                                       maxlength="11" value="<?php echo empty($storedValue["contact"]) ? "" : $storedValue["contact"]; ?>"/>
                                                <span class="invalid-feedback"><?php echo empty($error["contact"]) ? "" : $error["contact"]; ?></span>
                                            </div>
                                        </div><br/><br/>

                                    </fieldset> 
                                    <!--************************Button***************************-->
                                    <div class="row">
                                        <div class="col-md">
                                            <center>
                                                <!-- Prevent implicit submission of the form -->
                                                <button type="submit" disabled style="display: none" aria-hidden="true"></button>
                                                <input type="hidden" name="formDetect" value="formDetect">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                                <button type="button" class="btn btn-danger" onclick="location.href = 'announcement.php'">Cancel</button>
                                            </center>
                                        </div>
                                    </div><br/>

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
