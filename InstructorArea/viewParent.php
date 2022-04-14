<?php
include '../Function/load.php';
$pageName = basename(__FILE__);
include './Function/viewParent.php';
?>

<!DOCTYPE html>

<!--/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * InstructorArea/viewParent
 * 
 * author Tang Khai Li
 */-->

<?php
#Page Languages
$lang_title = "View Parent";
$lang_description = "View existing parent.";
$lang_legendTitle = "Parent Details";
?>

<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="parent.php">Parent</a></li>
                        <li class="breadcrumb-item active">View Parent</li>
                    </ol>
                    <div class="container-fluid">
                        <div id="formControl">
                            <div class="jumbotrun" id="container">
                                <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                <p class="lead"><?php echo $lang_description; ?> <span class="required"><?php echo $lang_required; ?></span></p>
                                <hr class="my-3">
                                <div class="form-group">
                                    <fieldset>
                                        <legend><?php echo $lang_legendTitle; ?></legend>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="parentID" class="col-form-label">Parent ID </label>
                                                <p class="p-12 font-weight-bold"><?php echo $getParent->parentID; ?></p>

                                            </div>
                                            <div class="col-md">
                                                <label for="parentName" class="col-form-label">Parent Name</label>
                                                <p class="p-12 font-weight-bold"><?php echo $getParent->parentName; ?> </p>
                                                <br/>
                                                </p>
                                            </div>
                                        </div>
                                        
                                </div>
                                   
                                  
                            </div>
                                <input hidden="true" name="formDetect" value="formDetect">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
    </body>
</html>