<?php include 'Function/load.php';require_once "Database/ChildClassDB.php";include 'Function/viewhomework.php'; ?>
<?php $childID = $_SESSION["childID"]; ?>
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
$lang_title = "View existing homework";
$lang_description = "View an existing homework.";
$lang_legendTitle = "Homework Details";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php'; ?>
        <script src="js/homeworks.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Announcement</a></li>
                    <li class="breadcrumb-item"><a href="homeworks.php?id=<?php echo $retrievedHomework->class; ?>'">Homeworks</a></li>
                    <li class="breadcrumb-item active">View Homework</li>
                </ol>
                
            </div>
            <div class="container">
                <div class="alert alert-dismissible alert-danger">
                    Do you want switch to another child?  <a href="selectchild.php?transferpath=homework" class="alert-link">Switch Child</a>
                </div>
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
                                                <label for="class" class="col-form-label">Class</label>
                                                <p class="p-12 font-weight-bold"><b><?php echo $retrievedHomework->class; ?></b></p>
                                            </div>
                                            <div class="col-md">
                                                <label for="date" class="col-form-label">Date</label>
                                                <p class="p-12 font-weight-bold"><b><?php echo $retrievedHomework->date; ?></b></p>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md">
                                                <h5>Homeworks</h5>
                                                <hr/>
                                                <?php echo htmlspecialchars_decode($retrievedHomework->homework); ?>
                                            </div>

                                        </div>
                                    </fieldset>
                                </div>
                                <input hidden="true" name="formDetect" value="formDetect">
                                <center>
                                    <button type="button" class="btn btn-danger" onclick="location.href='homeworks.php?id=<?php echo $retrievedHomework->class; ?>'">Back</button>
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
