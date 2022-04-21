<?php
include '../Function/load.php';
$pageName = basename(__FILE__);
include 'Function/addChild.php';
?>

<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================

@author Tang Khai Li
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Child</title>
        <?php
        include './Components/headmeta.php';
        ?>
        <style>
            .required{
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
                        <li class="breadcrumb-item"><a href="announcement.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="parent.php">Parent</a></li>
                        <li class="breadcrumb-item active">Add Child</li>
                    </ol>

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <form method="POST" id="formSubmit" name="formSubmit" enctype="multipart/form-data">
                                    <h1 class="display-4">Add Child</h1>
                                    <p class="lead">Add a new child<span class="required">  * Required Fields</span></p>
                                    <hr class="my-3">
                                    <div class ="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Child's Name:<span class="required">*</span></label>
                                            <input name = "childName" class="bg-white form-control <?php echo empty($error["childName"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter child name here." value="<?php echo empty($storedValue["childName"])?"":$storedValue["childName"] ?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["childName"]) ? "" : $error["childName"]; ?></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Child Birthday:
                                                <span class="required">*</span></label>
                                            <input name = "childBirthDate" class="bg-white form-control <?php echo empty($error["childBirthDate"]) ? "" : "is-invalid"; ?>" 
                                                   type="date" placeholder="Enter child birthday here." value="<?php echo empty($storedValue["childBirthDate"])?"":$storedValue["childBirthDate"] ?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["childBirthDate"]) ? "" : $error["childBirthDate"]; ?></span>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">

                                        <div class="col-md">
                                            <label class="col-form-label">Enter Child IC Number:
                                                <span class="required">*</span></label>
                                            <input name = "childIC" class="bg-white form-control  <?php echo empty($error["childIC"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter child IC numbers." value="<?php echo empty($storedValue["childIC"])?"":$storedValue["childIC"]?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["childIC"]) ? "" : $error["childIC"]; ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="childStatus" class="form-label mt-4">Select Child's Status:</label>
                                                <br>
                                                <select class="form-select" name="childStatus" 
                                                        id="childStatus">
                                                    <option value="Graduated" <?php echo empty($storedValue["childStatus"])?"":($storedValue["childStatus"]=="Graduated"?"selected":"")?>>Graduated</option>
                                                    <option value="Active" <?php echo empty($storedValue["childStatus"])?"":($storedValue["childStatus"]=="Active"?"selected":"")?>>Active</option>
                                                    <option value="Inactive" <?php echo empty($storedValue["childStatus"])?"":($storedValue["childStatus"]=="Inactive"?"selected":"")?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md"></div>
                                        <div class="col-md">
                                            <button type="submit" class="btn btn-primary" name="submitBtn">Submit</button>
                                        </div>
                                        <div class="col-md"></div>
                                    </div>
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
