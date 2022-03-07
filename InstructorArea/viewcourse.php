<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<?php include '../Function/load.php' ?>
<?php include 'Function/viewcourse.php' ?>
<?php
#Page Languages
$lang_legendTitle = "Course Details";
$lang_legendTitle2 = "Course Materials"
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="content-wrapper">
                <div id="content">
                    <div class="container-fluid">
                        <div id="formControl">
                            <div class="jumbotrun" id="container">
                                <h1 class="display-4">View <?php echo $retrievedCourse->courseCode ?> Details</h1>
                                <hr class="my-3">
                                <fieldset>
                                    <legend><?php echo $lang_legendTitle; ?></legend>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="courseCode" class="col-form-label">Course Code <span class="required">*</span></label>
                                            <p class="p-12 font-weight-bold"><?php echo $retrievedCourse->courseCode; ?></p>

                                        </div>
                                        <div class="col-md">
                                            <label for="courseName" class="col-form-label">Course Name <span class="required">*</span></label>
                                            <p class="p-12 font-weight-bold"><?php echo $retrievedCourse->courseName; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="courseDescription" class="col-form-label">Course Description <span class="required">*</span></label>
                                            <div><?php echo $retrievedCourse->courseName; ?></div>
                                        </div>
                                    </div>
                                </fieldset>
                                <br/>
                                <?php if (count($retrievedCourse->courseMaterials)!=0){ ?>
                                <fieldset>
                                    <legend><?php echo $lang_legendTitle2; ?></legend>
                                    <?php 
                                        for ($i = 0;$i < count($retrievedCourse->courseMaterials);$i++){
                                            $material = $retrievedCourse->courseMaterials[$i];
                                    ?>
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">List group item heading</h5>
                                                    <small>3 days ago</small>
                                                </div>
                                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                                <small>File Size: <?php echo filesize(str_replace("InstructorArea", "", dirname(__DIR__)).'/uploads/CourseMaterial/'.$material->materialLink) ?></small>
                                            </a>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                </fieldset>
                                <?php } ?>
                                <center>
                                    <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                    <button type="button" class="btn btn-warning" onclick="location.href = 'createcourse.php'">Reset</button>
                                    <button type="button" class="btn btn-danger" onclick="location.href = 'courses.php'">Cancel</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
