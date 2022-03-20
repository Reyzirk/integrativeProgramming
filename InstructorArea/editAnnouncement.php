<?php
include '../Function/load.php';
?>
<?php
include './Function/editAnnouncement.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================

@author Oon Kheng Huang
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Announcement</title>
        <?php
        include './Components/headmeta.php';
        ?>
        <style>
            body{
                background-color: #f8f9fc;
            }
            .requiredF{
                color:red;
                font-size:12pt;
            }
            .ck-editor__editable {
                min-height: 250px;
            }
        </style>
        <script src="js/editAnnouncement.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                        <li class="breadcrumb-item active">Edit Announcement</li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <form method="POST" id="formSubmit" name="formSubmit" enctype="multipart/form-data">
                                    <h1 class="display-4">Edit Announcement</h1>
                                    <p class="lead">Edit an existing announcement <span class="requiredF">* Required Fields</span></p>
                                    <hr class="my-3">
                                    <fieldset>
                                        <legend>Announcement Details</legend>
                                        <!--************************Date***************************-->
                                        <div class="row">
                                            <div class="col-md">
                                                Modify Date: <?php echo date("Y-m-d") . " (" . date("l") . ")" ?>
                                                <input type="hidden" name="hiddenDate" value="<?php echo date("Y-m-d") ?>"/>
                                            </div>
                                        </div><br/>
                                        <!--************************Title***************************-->
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="title" class="col-form-label">Title <span class="requiredF">*</span></label>
                                                <input id="titleA" type="text" name="titleA" class="bg-white form-control <?php echo empty($error["title"]) ? "" : "is-invalid"; ?>" placeholder="Please enter an announcement title" 
                                                       maxlength="50" oninput="validateTitle()" value="<?php echo empty($storedValue["title"]) ? "" : $storedValue["title"]; ?>"/>
                                                <span class="invalid-feedback"><?php echo empty($error["title"]) ? "" : $error["title"]; ?></span>
                                            </div>
                                        </div><br/>
                                        <!--************************Description***************************-->
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="desc" class="col-form-label">Description <span class="requiredF">*</span></label>
                                                <textarea id="desc" maxlength="5000" rows="10" class="bg-white form-control editor <?php echo empty($error["desc"]) ? "" : "is-invalid"; ?>" 
                                                          placeholder="Please enter annoncement description" name="desc">
                                                              <?php echo empty($storedValue["desc"]) ? "" : $storedValue["desc"]; ?>
                                                </textarea>
                                                <span class="invalid-feedback" id="descFeedBack"><?php echo empty($error["desc"]) ? "" : $error["desc"]; ?></span>

                                            </div>
                                        </div><br/>
                                        <!--************************Category***************************-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="cat" class="col-form-label">Category <span class="requiredF">*</span></label>
                                                <select id="cat" name="cat" class="bg-white form-control <?php echo empty($error["cat"]) ? "" : "is-invalid"; ?>" onchange="validateCat()">
                                                    <option selected value="">-Select-</option>
                                                    <option value="A" <?php echo empty($storedValue["cat"]) ? "" : (($storedValue["cat"] == "A") ? "selected" : ""); ?>>Activity</option>
                                                    <option value="C" <?php echo empty($storedValue["cat"]) ? "" : (($storedValue["cat"] == "C") ? "selected" : ""); ?>>Covid-19</option> 
                                                    <option value="E" <?php echo empty($storedValue["cat"]) ? "" : (($storedValue["cat"] == "E") ? "selected" : ""); ?>>Examination</option>
                                                    <option value="H" <?php echo empty($storedValue["cat"]) ? "" : (($storedValue["cat"] == "H") ? "selected" : ""); ?>>Homework</option>
                                                    <option value="N" <?php echo empty($storedValue["cat"]) ? "" : (($storedValue["cat"] == "N") ? "selected" : ""); ?>>Notice</option>
                                                    <option value="T" <?php echo empty($storedValue["cat"]) ? "" : (($storedValue["cat"] == "T") ? "selected" : ""); ?>>Tuition</option>
                                                    <option value="W" <?php echo empty($storedValue["cat"]) ? "" : (($storedValue["cat"] == "W") ? "selected" : ""); ?>>News</option>      
                                                </select>
                                                <span class="invalid-feedback"><?php echo empty($error["cat"]) ? "" : $error["cat"]; ?></span>
                                            </div>
                                            <!--************************Attachment***************************-->

                                            <div class="col-md-6">
                                                <label for="attach" class="col-form-label">Attachment</label>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <input id="attach" type="file" class="form-control-file bg-white form-control <?php echo empty($error["attach"]) ? "" : "is-invalid"; ?>" oninput="validateAttach(this)" name="attach[]" multiple /> 
                                                        <span class="invalid-feedback" style="background-color:#f8f9fc;border:none;"><?php echo empty($error["attach"]) ? "" : $error["attach"]; ?></span>
                                                        <span style="padding-left: 5px;">File Name: <?php echo empty($storedValue["attach"]) ? "No File...." : implode("<br/>", $storedValue["attach"]); ?></span>
                                                        <input type="hidden" name="hiddenAttach" value=""/>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-warning" onclick="clearFileFunction()">Clear</button>
                                                    </div>
                                                </div>



                                            </div>

                                        </div><br>
                                        <!--************************Comment***************************-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="allowC" class="col-form-label">Comment</label><br/>
                                                <input type="checkbox" name="allowC" id="allowC" value="checked" <?php echo empty($storedValue["allowC"]) ? "" : (($storedValue["allowC"] == 1) ? "checked" : ""); ?>>Don't allow user comment
                                            </div>
                                            <div class="col-md-6">
                                                <label for="pinTop" class="col-form-label">Pin Announcement</label><br/>
                                                <input type="checkbox" name="pinTop" id="pinTop" value="checked" <?php echo empty($storedValue["pinTop"]) ? "" : (($storedValue["pinTop"] == 1) ? "checked" : ""); ?>>Pin on top
                                            </div>
                                        </div><br/>
                                        <div class="row">

                                        </div><br/>


                                    </fieldset> 
                                    <!--************************Button***************************-->
                                    <div class="row">
                                        <div class="col-md">
                                            <center>
                                                <!-- Prevent implicit submission of the form -->
                                                <button type="submit" disabled style="display: none" aria-hidden="true"></button>
                                                <input type="hidden" name="formDetect" value="formDetect">
                                                <button type="button" class="btn btn-success" onclick="validateA()">Submit</button>
                                                <button type="button" class="btn btn-danger" onclick="location.href = 'announcement.php'">Cancel</button>
                                            </center>
                                        </div>
                                    </div>

                                </form>
                                <form id="clearFile" name="clearFile" method="POST">
                                    <input type="hidden" name="confirmFile" value="confirmFile">
                                </form>
                            </div>
                        </div>                       
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
        <script>
            function clearFileFunction() {
                document.getElementById("clearFile").submit();
                return true;
            }
        </script>
        <script>
            ClassicEditor
                    .create(document.querySelector('#desc'))
                    .then(editor => {
                        validateTextArea(editor.getData());
                        editor.model.document.on('change:data', (evt, data) => {
                            validateTextArea(editor.getData());


                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
<?php
echo "maxFileSize = " . $generalSection["file_max_size"] . ";";
?>

        </script>
    </body>
</html>
