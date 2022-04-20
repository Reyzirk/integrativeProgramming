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
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Child</title>
        <?php
        include './Components/headmeta.php';
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Add Child</li>
                    </ol>

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <form method="POST" id="formSubmit" name="formSubmit" enctype="multipart/form-data">
                                    <h1 class="display-4">Add Child</h1>
                                    <p class="lead">Add a new child<span class="requiredF">* Required Fields</span></p>
                                    <hr class="my-3">
                                    <div class ="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Child's Name:<span class="required">*</span></label>
                                            <input name = "childName" class="bg-white form-control" 
                                                   type="text" placeholder="Enter child's name here."/>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Child Birthday:
                                                <span class="required">*</span></label>
                                            <input name = "childBirthDate" class="bg-white form-control" 
                                                   type="date" placeholder="Enter Child birthday here."/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">

                                        <div class="col-md">
                                            <label class="col-form-label">Enter Child IC Number:
                                                <span class="required">*</span></label>
                                            <input name = "childIC" class="bg-white form-control" 
                                                   type="text" placeholder="Enter Child IC numbers."/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="childStatus" class="form-label mt-4">Select Child's Status:</label>
                                                <br>
                                                <select class="form-select" name="childStatus" 
                                                        id="childStatus">
                                                    <option value="Graduated">Graduated</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
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