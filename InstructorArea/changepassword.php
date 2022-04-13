<?php
include '../Function/load.php';$pageName = basename(__FILE__); 
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
        <title>Change Password</title>
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
                        <li class="breadcrumb-item active">Parent</li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <div id="displayList">
                                <div class="jumbotrun" id="container">
                                    <form method="POST" id="formSubmit" name="formSubmit" enctype="multipart/form-data">
                                    <h1 class="display-4">Change Password</h1>
                                    <p class="lead">Change instructor password <span class="requiredF">* Required Fields</span></p>
                                    <hr class="my-3">
                                    <fieldset>
                                        <legend>Password</legend>
                                        <!--************************Current Password***************************-->
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="currentPass" class="col-form-label">Current Password <span class="requiredF">*</span></label>
                                                <input id="currentPass" type="text" name="currentPass" class="bg-white form-control <?php echo empty($error["currentPass"]) ? "" : "is-invalid"; ?>" placeholder="Please enter current password" 
                                                       maxlength="100" value="<?php echo empty($storedValue["currentPass"]) ? "" : $storedValue["currentPass"]; ?>"/>
                                                <span class="invalid-feedback"><?php echo empty($error["currentPass"]) ? "" : $error["currentPass"]; ?></span>
                                            </div>
                                        </div><br/>
                                        <!--************************New Password***************************-->
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="newPass" class="col-form-label">New Password <span class="requiredF">*</span></label>
                                                <input id="currentPass" type="text" name="newPass" class="bg-white form-control <?php echo empty($error["newPass"]) ? "" : "is-invalid"; ?>" placeholder="Please enter new password" 
                                                       maxlength="100" value="<?php echo empty($storedValue["newPass"]) ? "" : $storedValue["newPass"]; ?>"/>
                                                <span class="invalid-feedback"><?php echo empty($error["newPass"]) ? "" : $error["newPass"]; ?></span>
                                            </div>
                                        </div><br/>
                                        <!--************************Confirm Password***************************-->
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="confirmPass" class="col-form-label">Confirm Password <span class="requiredF">*</span></label>
                                                <input id="currentPass" type="text" name="confirmPass" class="bg-white form-control <?php echo empty($error["confirmPass"]) ? "" : "is-invalid"; ?>" placeholder="Please re-enter new password" 
                                                       maxlength="100" value="<?php echo empty($storedValue["confirmPass"]) ? "" : $storedValue["confirmPass"]; ?>"/>
                                                <span class="invalid-feedback"><?php echo empty($error["confirmPass"]) ? "" : $error["confirmPass"]; ?></span>
                                            </div>
                                        </div><br/>

                                    </fieldset> 
                                    <!--************************Button***************************-->
                                    <div class="row">
                                        <div class="col-md">
                                            <center>
                                                <!-- Prevent implicit submission of the form -->
                                                <button type="submit" disabled style="display: none" aria-hidden="true"></button>
                                                <input type="hidden" name="formDetect" value="formDetect">
                                                <button type="button" class="btn btn-success" onclick="//put js validation here">Submit</button>
                                                <button type="button" class="btn btn-danger" onclick="location.href = 'parent.php'">Cancel</button>
                                            </center>
                                        </div>
                                    </div>

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
