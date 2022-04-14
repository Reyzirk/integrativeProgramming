<?php include '../Function/load.php';$pageName = basename(__FILE__); ?>
<?php include 'Function/edithomework.php';?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
//Author: Poh Choo Meng
-->


<?php
#Page Languages
$lang_title = "Edit existing homework";
$lang_description = "Edit an existing homework.";
$lang_required = "* Required Fields";
$lang_legendTitle = "Homework Details";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
        <script src="js/edithomework.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.jsp">Home</a></li>
                        <li class="breadcrumb-item"><a href="homeworks.jsp">Homework</a></li>
                        <li class="breadcrumb-item active">Edit Homework</li>
                    </ol>
                    <div class="container-fluid">
                        <div id="formControl">
                            <div class="jumbotrun" id="container">
                                <form method="POST" id="form" name="form">
                                    <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                    <p class="lead"><?php echo $lang_description; ?> <span class="required"><?php echo $lang_required; ?></span></p>
                                    <hr class="my-3">
                                    <div class="form-group">
                                        <fieldset>
                                            <legend><?php echo $lang_legendTitle; ?></legend>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="classID" class="col-form-label">Class ID</label>
                                                    <input class="bg-white form-control" disabled
                                                           id="classID" name="classID" value="<?php echo empty($storedValue["classID"])?"":$storedValue["classID"]; ?>"/>
                                                </div>
                                                <div class="col-md">
                                                    <label for="date" class="col-form-label">Date <span class="required">*</span></label>
                                                    <input type="date" placeholder="Enter the date" class="bg-white form-control <?php echo empty($error["date"])?"":"is-invalid"; ?>" 
                                                           id="date" name="date" oninput="validateDate()" value="<?php echo empty($storedValue["date"])?"":$storedValue["date"]; ?>"/>
                                                    <span class="invalid-feedback"><?php echo empty($error["date"])?"":$error["date"]; ?></span>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="homework" class="col-form-label">Homework <span class="required">*</span></label>
                                                    <textarea maxlength="999999" rows="6"  class="bg-white form-control editor <?php echo empty($error["homework"]) ? "" : "is-invalid"; ?>" 
                                                              id="homework" name="homework">
                                                                  <?php echo empty($storedValue["homework"]) ? "" : $storedValue["homework"]; ?>
                                                    </textarea>
                                                    <div id="word-count">
                                                    </div>
                                                    <span class="invalid-content" id="feedbackHomework"><?php echo empty($error["homework"]) ? "" : $error["homework"]; ?></span>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>
                                    <input hidden="true" name="formDetect" value="formDetect">
                                    <center>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                        <button type="button" class="btn btn-danger" onclick="location.href='homeworks.php?id=<?php echo $storedValue["classID"]; ?>'">Cancel</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
        <script>
            ClassicEditor
                .create(document.querySelector('.editor'), {

                })
                .then(editor => {
                    window.editor = editor;
                    const wordCountPlugin = editor.plugins.get('WordCount');
                    const wordCountWrapper = document.getElementById('word-count');

                    wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);
                })
        </script>
    </body>
</html>
