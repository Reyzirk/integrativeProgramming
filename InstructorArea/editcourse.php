<?php include '../Function/load.php' ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<?php include 'Function/editcourse.php' ?>
<?php
#Page Languages
$lang_title = "Edit existing course";
$lang_description = "Edit an existing course.";
$lang_required = "* Required Fields";
$lang_legendTitle = "Course Details";
$lang_legendTitle2 = "Course Materials"
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
        <script src="js/editcourse.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="content-wrapper">
                <div id="content">
                    <div class="container-fluid">
                        <div id="formControl">
                            <div class="jumbotrun" id="container">
                                <form method="POST" id="form" name="form" enctype="multipart/form-data">
                                    <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                    <p class="lead"><?php echo $lang_description; ?> <span class="required"><?php echo $lang_required; ?></span></p>
                                    <hr class="my-3">
                                    <div class="form-group">
                                        <fieldset>
                                            <legend><?php echo $lang_legendTitle; ?></legend>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="courseCode" class="col-form-label">Course Code <span class="required">*</span></label>
                                                    <input type="text" maxlength="10" placeholder="Enter the course code" class="bg-white form-control <?php echo empty($error["courseCode"]) ? "" : "is-invalid"; ?>" 
                                                           id="courseCode" name="courseCode" oninput="validateCourseCode()" value="<?php echo empty($storedValue["courseCode"]) ? "" : $storedValue["courseCode"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["courseCode"]) ? "" : $error["courseCode"]; ?></span>
                                                </div>
                                                <div class="col-md">
                                                    <label for="courseName" class="col-form-label">Course Name <span class="required">*</span></label>
                                                    <input type="text" maxlength="300" placeholder="Enter the course name" class="bg-white form-control <?php echo empty($error["courseName"]) ? "" : "is-invalid"; ?>" 
                                                           id="courseName" name="courseName" oninput="validateCourseName()" value="<?php echo empty($storedValue["courseName"]) ? "" : $storedValue["courseName"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["courseName"]) ? "" : $error["courseName"]; ?></span>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="courseDescription" class="col-form-label">Course Description <span class="required">*</span></label>
                                                    <textarea maxlength="99999" rows="5" placeholder="Enter the course description" class="bg-white form-control editor <?php echo empty($error["courseDescription"]) ? "" : "is-invalid"; ?>" 
                                                              id="courseDescription" name="courseDescription">
                                                                  <?php echo empty($storedValue["courseDescription"]) ? "" : $storedValue["courseDescription"]; ?>
                                                    </textarea>
                                                    <div id="word-count">
                                                    </div>
                                                    <span class="invalid-content" id="feedbackText"><?php echo empty($error["courseDescription"]) ? "" : $error["courseDescription"]; ?></span>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <br/>
                                        <fieldset>
                                            <legend><?php echo $lang_legendTitle2; ?></legend>
                                            <span class="invalid-content"><?php echo empty($error["materialName"])?"":$error["materialName"]."<br/>"; ?></span>
                                            <span class="invalid-content"><?php echo empty($error["materialFile"])?"":$error["materialFile"]; ?></span>
                                            <table class="table" id="courseMaterials">
                                                <thead class=" table-info">
                                                    <tr>
                                                        <th width="65%">Material Name</th>
                                                        <th width="30%">File</th>
                                                        <th width="100"></th>
                                                    </tr>

                                                </thead>
                                                <tbody class="table-secondary">
                                                    <?php 
                                                        for ($i = 0;$i < count($storedValue["courseMaterials"]);$i++){
                                                            $material = $storedValue["courseMaterials"][$i];
                                                    ?>
                                                        <tr class="material">
                                                            <td>
                                                                <input type="text" maxlength="300" placeholder="Enter the material name" class="bg-white form-control materialName" 
                                                                       id="materialName" name="materialName[]" oninput="validateMaterialName(this)" value="<?php echo $material->materialName; ?>"/>
                                                                <span class="invalid-feedback"></span>
                                                            </td>
                                                            <td>
                                                                <div class="form-group bg-white" style="border-radius:0.35rem; border: 1px solid #d1d3e2; ">
                                                                    <input type="file" class="form-control-file materialFile" id="materialFile" name="materialFile[]" style="padding: 5px 10px;cursor:pointer;" oninput="validateFile(this)"/>
                                                                    <span class="invalid-feedback" style="background-color:rgb(221, 221, 226);border:none;"></span>
                                                                    <span style="padding-left: 5px;">File Name: <?php echo $material->materialLink; ?></span>
                                                                    <input type="hidden" name="materialHiddenFile[]" value="<?php echo $material->materialLink; ?>"/>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-danger" type="button" title="Delete material" onclick="removeRow(this)"><i class="fa-solid fa-trash-can"></i></button>
                                                            </td>
                                                        </tr>

                                                    <?php
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center"><button type="button" class="btn btn-info" onclick="addNewRow()" title="Add new material"><i class="fa-solid fa-plus"></i></button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </fieldset>
                                    </div>
                                    <input hidden="true" name="formDetect" value="formDetect">
                                    <center>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                        <button type="button" class="btn btn-warning" onclick="location.href = 'createcourse.php'">Reset</button>
                                        <button type="button" class="btn btn-danger" onclick="location.href = 'courses.php'">Cancel</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            ClassicEditor
                .create(document.querySelector('.editor'), {

                })
                .then(editor => {
                    window.editor = editor;
                    editor.model.document.on('change:data', (evt, data) => {
                        validateCourseDescription(editor.getData());
                    });
                    const wordCountPlugin = editor.plugins.get('WordCount');
                    const wordCountWrapper = document.getElementById('word-count');

                    wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);
                })
                <?php 
                if (!empty($storedValue["courseDescription"])){
                    echo "invalidDescription = false;";
                    
                }
                echo "maxFileSize = ".$generalSection["file_max_size"].";";
                ?>
        </script>
    </body>
</html>
