<?php include 'Function/load.php';include 'Function/viewchild.php'; ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================

@author Tang Khai Li
-->
<?php
#Page Languages
$lang_title = "View Child";
$lang_description = "View child details";
$lang_legendTitle = "Child Details";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php'; ?>
    </head>
    <body>
        <?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                    <li class="breadcrumb-item"><a href="childlist.php">Child List</a></li>
                    <li class="breadcrumb-item active">View Child</li>
                </ol>
                
            </div>
            
            <section id="classes" class="classes">
                
                <div class="container">
                    <div id="formControl">
                        <div class="jumbotrun" id="container">
                            <form method="POST" id="form" name="form">
                                <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                <p class="lead"><?php echo $lang_description; ?> </p>
                                <hr class="my-3">
                                <div class="form-group">
                                    <fieldset>
                                        <legend><?php echo $lang_legendTitle; ?></legend>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="childid" class="col-form-label">Child ID </label>
                                                <p class="p-12 font-weight-bold"><?php echo $result->childID; ?></p>

                                            </div>
                                            <div class="col-md">
                                                <label for="childname" class="col-form-label">Child Name </label>
                                                <p class="p-12 font-weight-bold"><?php echo $result->childName; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="BirthDate" class="col-form-label">Birth Date </label>
                                                <p class="p-12 font-weight-bold"><?php echo $result->birthDate; ?></p>

                                            </div>
                                            <div class="col-md">
                                                <label for="ChildICNo" class="col-form-label">Child IC No </label>
                                                <p class="p-12 font-weight-bold"><?php echo $result->childICNo; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <label for="Status" class="col-form-label">Status </label>
                                                <p class="p-12 font-weight-bold"><?php echo $result->status; ?></p>

                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <input hidden="true" name="formDetect" value="formDetect">
                                <center>
                                    <button type="button" class="btn btn-danger" onclick="location.href='childlist.php'">Back</button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <br/>
        <?php include 'Components/footer.php' ?>
    </body>
</html>
