<?php
include '../Function/load.php';
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
        <title>Create Announcement</title>
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
        <script src="js/createAnnouncement.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <form method="POST" id="formSubmit" enctype="multipart/form-data">
                        <h1 class="display-4">Create Announcement</h1>
                        <p class="lead">Create a new announcement <span class="requiredF">* Required Fields</span></p>
                        <hr class="my-3">
                        <fieldset>
                            <legend>Announcement Details</legend>
                            <!--************************Date***************************-->
                            <div class="row">
                                <div class="col-md">
                                    Date: <?php echo date("Y/m/d") . " " . date("l") ?>
                                    <input type="hidden" name="hiddenDate" value="<?php echo date("Y/m/d") ?>"/>
                                </div>
                            </div><br/>
                            <!--************************Title***************************-->
                            <div class="row">
                                <div class="col-md">
                                    <label for="title" class="col-form-label">Title <span class="requiredF">*</span></label>
                                    <input id="title" type="text" name="title" class="bg-white form-control" placeholder="Please enter an announcement title" 
                                           maxlength="50" oninput="validateTitle()" value=""/><span class="invalid-feedback"></span>
                                </div>
                            </div><br/>
                            <!--************************Description***************************-->
                            <div class="row">
                                <div class="col-md">
                                    <label for="desc" class="col-form-label">Description <span class="requiredF">*</span></label>
                                    <textarea id="desc" maxlength="5000" rows="10" class="bg-white form-control editor" 
                                              placeholder="Please enter annoncement description" name="desc"></textarea>
                                    <span class="invalid-feedback" id="descFeedBack"></span>

                                </div>
                            </div><br/>
                            <!--************************Category***************************-->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="cat" class="col-form-label">Category <span class="requiredF">*</span></label>
                                    <select id="cat" name="cat" class="bg-white form-control" onchange="validateCat()">
                                        <option selected value="">-Select-</option>
                                        <option value="A">Activity</option>
                                        <option value="C">Covid-19</option> 
                                        <option value="E">Examination</option>
                                        <option value="H">Homework</option>
                                        <option value="N">Notice</option>
                                        <option value="T">Tuition</option>
                                        <option value="W">News</option>      
                                    </select>
                                    <span class="invalid-feedback"></span>
                                </div>
                                <!--************************Attachment***************************-->
                                <div class="col-md-6">
                                    <label for="attach" class="col-form-label">Attachment</label>
                                    <input id="attach" type="file" class="form-control-file bg-white form-control" oninput="validateAttach(this)" name="attach[]" multiple />
                                    <span class="invalid-feedback" style="background-color:#f8f9fc;border:none;"></span>
                                    <input type="hidden" name="hiddenAttach" value=""/>
                                </div>
                            </div><br>
                            <!--************************Comment***************************-->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="allowC" class="col-form-label">Comment</label><br/>
                                    <input type="checkbox" name="allowC" id="allowC" value="checked">Don't allow user comment
                                </div>
                                <div class="col-md-6">
                                    <label for="pinTop" class="col-form-label">Pin Announcement</label><br/>
                                    <input type="checkbox" name="pinTop" id="pinTop" value="checked">Pin on top
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
                                    
                                    <button type="button" class="btn btn-success" onclick="validateA()">Submit</button>
                                    <button type="button" class="btn btn-warning" onclick="location.href = location.href">Reset</button>
                                    <button type="button" class="btn btn-danger" onclick="">Cancel</button>
                                </center>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>

        <?php
        //include '../Components/footer.php';
       
        ?>
        <script>
            ClassicEditor
                    .create(document.querySelector('#desc'))
                    .then(editor => {
                        editor.model.document.on('change:data', (evt, data) => {
                            validateTextArea(editor.getData());


                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });

        </script>
        <br/><br/>
    </body>
</html>
