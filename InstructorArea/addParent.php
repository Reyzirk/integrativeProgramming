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
                        <li class="breadcrumb-item active">Add Parent</li>
                    </ol>

                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <form method="POST" id="formSubmit" name="formSubmit" enctype="multipart/form-data">
                                    <h1 class="display-4">Add Parents</h1>
                                    <p class="lead">Add a new parent<span class="required">* Required Fields</span></p>
                                    <hr class="my-3">
                                    <div class ="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent's Name:<span class="required">*</span></label>
                                            <input name = "parentName" class="bg-white form-control <?php echo empty($error["parentName"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter parent name here." value="<?php echo empty($storedValue["parentName"])?"":$storedValue["parentName"] ?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["parentName"]) ? "" : $error["parentName"]; ?></span>
                                        </div>
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent's Gender:
                                                <span class="required">*</span></label><br/>
                                            <input type="radio" id="male" name="parentGender" value="male" <?php echo empty($storedValue["parentGender"]) ? "" : ($storedValue["parentGender"] == "male" ? "checked" : "") ?>>
                                            <label for="male">Male</label>
                                            <input type="radio" id="female" class="<?php echo empty($error["parentGender"]) ? "" : "is-invalid"; ?>" name="parentGender" value="female" <?php echo empty($storedValue["parentGender"]) ? "" : ($storedValue["parentGender"] == "female" ? "checked" : "") ?>>
                                            <label for="female">Female</label><br>
                                            <span class="invalid-feedback "><?php echo empty($error["parentGender"]) ? "" : $error["parentGender"]; ?></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent Birthday:
                                                <span class="required">*</span></label>
                                            <input name = "parentBirthday" class="bg-white form-control <?php echo empty($error["parentBirthday"]) ? "" : "is-invalid"; ?>" 
                                                   type="date" placeholder="Enter parent birthday here." value="<?php echo empty($storedValue["parentBirthday"])?"":$storedValue["parentBirthday"] ?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["parentBirthday"]) ? "" : $error["parentBirthday"]; ?></span>
                                        </div>
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent Email:
                                                <span class="required">*</span></label>
                                            <input name = "parentEmail" class="bg-white form-control <?php echo empty($error["parentEmail"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter parent email here." value="<?php echo empty($storedValue["parentEmail"])?"":$storedValue["parentEmail"] ?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["parentEmail"]) ? "" : $error["parentEmail"]; ?></span>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent Phone Number:
                                                <span class="required">*</span></label>
                                            <input name = "parentPhoneNumber" class="bg-white form-control <?php echo empty($error["parentPhoneNumber"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter parent phone numbers." value="<?php echo empty($storedValue["parentPhoneNumber"])?"":$storedValue["parentPhoneNumber"]?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["parentPhoneNumber"]) ? "" : $error["parentPhoneNumber"]; ?></span>
                                        </div>
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Parent IC Number:
                                                <span class="required">*</span></label>
                                            <input name = "parentICNumber" class="bg-white form-control <?php echo empty($error["parentICNumber"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter parent IC numbers." value="<?php echo empty($storedValue["parentICNumber"])?"":$storedValue["parentICNumber"]?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["parentICNumber"]) ? "" : $error["parentICNumber"]; ?></span>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="parentType" class="form-label mt-4">Select a parent type:</label>
                                                <br>
                                                <select class="form-select" name="parentType" 
                                                        id="parentType">
                                                    <option value="Guardian" <?php echo empty($storedValue["parentType"])?"":($storedValue["parentType"]=="Guardian"?"selected":"")?>>Guardian</option>
                                                    <option value="Father" <?php echo empty($storedValue["parentType"])?"":($storedValue["parentType"]=="Father"?"selected":"")?>>Father</option>
                                                    <option value="Mother" <?php echo empty($storedValue["parentType"])?"":($storedValue["parentType"]=="Mother"?"selected":"")?>>Mother</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md">
                                            <label class="col-form-label">Enter Address Location:
                                                <span class="required">*</span></label>
                                            <input name = "address" class="bg-white form-control <?php echo empty($error["address"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter Address." value="<?php echo empty($storedValue["address"])?"":$storedValue["address"]?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["address"]) ? "" : $error["address"]; ?></span>
                                            <br>
                                            <input name = "city" class="bg-white form-control <?php echo empty($error["city"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter City" value="<?php echo empty($storedValue["city"])?"":$storedValue["city"]?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["city"]) ? "" : $error["city"]; ?></span>
                                            <br>
                                            <input name = "state" class="bg-white form-control <?php echo empty($error["state"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter State" value="<?php echo empty($storedValue["state"])?"":$storedValue["state"]?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["state"]) ? "" : $error["state"]; ?></span>
                                            <br>
                                            <input name = "postcode" class="bg-white form-control <?php echo empty($error["postcode"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter postcode." value="<?php echo empty($storedValue["postcode"])?"":$storedValue["postcode"]?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["postcode"]) ? "" : $error["postcode"]; ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="col-form-label">Enter Password:
                                                <span class="required">*</span></label>
                                            <input name = "password" class="bg-white form-control <?php echo empty($error["password"]) ? "" : "is-invalid"; ?>" 
                                                   type="text" placeholder="Enter Password here." value="<?php echo empty($storedValue["password"])?"":$storedValue["password"]?>"/>
                                            <span class="invalid-feedback"><?php echo empty($error["password"]) ? "" : $error["password"]; ?></span>
                                        </div>
                                    </div>
                                    <br/>
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





