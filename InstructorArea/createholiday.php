<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<?php include '../Function/load.php' ?>
<?php include 'Function/holidays.php' ?>
<?php
#Page Languages
$lang_title = "Create new holiday";
$lang_description = "Create a new holiday.";
$lang_required = "* Required Fields";
$lang_legendTitle = "Holiday";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
        <script src="js/holidays.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="content-wrapper">
                <div id="content">
                    <div class="container-fluid">
                        <div id="displayList">
                            <div class="jumbotrun" id="container">
                                <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                <p class="lead"><?php echo $lang_description; ?><br><span class="required"><?php echo $lang_required; ?></span></p>
                                <hr class="my-3">
                                <div class="form-group">
                                    <fieldset>
                                        <legend><?php echo $lang_legendTitle; ?></legend>
                                        
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
