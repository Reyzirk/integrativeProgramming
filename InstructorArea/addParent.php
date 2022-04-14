<?php
include '../Function/load.php';
$pageName = basename(__FILE__);
include 'Function/addParent.php';
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
        <title>Parent</title>
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
                        <li class="breadcrumb-item active">Add Parent</li>
                    </ol>

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <form method="POST" id="formSubmit" name="formSubmit" enctype="multipart/form-data">
                                    <h1 class="display-4">Add Parents</h1>
                                    <p class="lead">Add a new parent<span class="requiredF">* Required Fields</span></p>
                                    <hr class="my-3">
                                    <div class ="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent's Name:<span class="required">*</span></label>
                                            <input name = "parentName" class="bg-white form-control" 
                                                   type="text" placeholder="Enter parent name here."/>
                                        </div>
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent's Gender:
                                                <span class="required">*</span></label>
                                            <input name = "parentGender" class="bg-white form-control" 
                                                   type="text" placeholder="Enter parent gender here."/>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent Birthday:
                                                <span class="required">*</span></label>
                                            <input name = "parentBirthday" class="bg-white form-control" 
                                                   type="text" placeholder="Enter parent birthday here."/>
                                        </div>
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent Email:
                                                <span class="required">*</span></label>
                                            <input name = "parentEmail" class="bg-white form-control" 
                                                   type="text" placeholder="Enter parent email here."/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent Phone Number:
                                                <span class="required">*</span></label>
                                            <input name = "parentPhoneNumber" class="bg-white form-control" 
                                                   type="text" placeholder="Enter parent phone numbers."/>
                                        </div>
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent IC Number:
                                                <span class="required">*</span></label>
                                            <input name = "parentICNumber" class="bg-white form-control" 
                                                   type="text" placeholder="Enter parent IC numbers."/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="exampleSelect1" class="form-label mt-4">Select a parent type:</label>
                                                <br>
                                                <select class="form-select" name="parentType" 
                                                        id="exampleSelect1">
                                                    <option value="Guardian">Guardian</option>
                                                    <option value="Father">Father</option>
                                                    <option value="Mother">Mother</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="parentAddress" class="form-label mt-4">Parent Address</label>
                                                <textarea class="form-control" id="parentAddress" rows="3" name="parentAddress"></textarea>
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





