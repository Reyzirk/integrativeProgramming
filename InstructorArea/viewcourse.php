<?php include '../Function/load.php' ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

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
                                <?php if (count($retrievedCourse->courseMaterials) != 0) { ?>
                                    <fieldset>
                                        <legend><?php echo $lang_legendTitle2; ?></legend>
                                        <?php
                                        $materialCount = 0;
                                        for ($i = 0; $i < count($retrievedCourse->courseMaterials); $i++) {
                                            $materialCount++;
                                            $material = $retrievedCourse->courseMaterials[$i];
                                            if ($materialCount % 2 == 1) {
                                                ?>
                                                <div class="row">
                                                <?php } ?>
                                                <div class="list-group col-md-6">
                                                    <div class="list-group-item list-group-item-action flex-column align-items-start active">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h5 class="mb-1"><?php echo $material->materialName ?></h5>
                                                            <small>File type: <?php echo strtoupper(pathinfo(str_replace("InstructorArea", "", dirname(__DIR__)) . '/uploads/CourseMaterial/' . $material->materialLink, PATHINFO_EXTENSION)); ?></small>
                                                        </div>

                                                        <small>File Size: <?php echo convertByteToOther(filesize(str_replace("InstructorArea", "", dirname(__DIR__)) . '/uploads/CourseMaterial/' . $material->materialLink)) ?></small>
                                                        <br/>
                                                        <center>
                                                            <a class="btn btn-light" href="<?php echo "../uploads/CourseMaterial/" . $material->materialLink; ?>">Access the file</a>
                                                        </center>
                                                    </div>
                                                </div>
                                                <?php
                                                if ($materialCount % 2 == 1) {
                                                    ?>
                                                </div>
                                            <?php } ?>
                                            <?php
                                        }
                                        ?>
                                    </fieldset>
                                <?php } ?>
                                <br/>
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
