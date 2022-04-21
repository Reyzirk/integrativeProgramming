<?php include 'Function/load.php';require_once "Database/ChildDB.php";include 'Function/selectchild.php'; ?>
<?php $parentID = $_SESSION["parentID"]; ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
//Author: Tang Khai Li
-->

<html>
    <head>
        <?php include 'Components/headmeta.php'; ?>
        <script src="js/selectchild.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                    <li class="breadcrumb-item active">Select Child</li>
                </ol>
            </div>

            <br/>
            <section id="classes" class="classes">
                
                <div class="container aos-init aos-animate" data-aos="fade-up">
                    <div id="formControl">
                        <div class="jumbotrun" id="container">
                            <form method="POST" id="form" name="form">
                                <h1 class="display-4">Select the child to view</h1>
                                
                                <hr class="my-3">
                                <div class="form-group">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-3">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="child" class="col-form-label">Child <span class="required">*</span></label>
                                                <select class="form-select bg-white" id="child" name="child" oninput="validateChild()" >
                                                    <?php
                                                        $childdb = new ChildDB();
                                                        $result = $childdb->getChildList($parentID);
                                                        foreach ($result as $row) {
                                                            ?>
                                                            <option value="<?php echo $row["ChildID"]; ?>"><?php echo $row["ChildName"]; ?></option>
                                                        <?php } ?>
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                            <div class="col-md-3">
                                            </div>
                                        </div>
                                        <br/>
                                        
                                    </fieldset>
                                </div>
                                <input hidden="true" name="formDetect" value="formDetect">
                                <center>
                                    <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm();">Submit</button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include 'Components/footer.php' ?>
    </body>
</html>
