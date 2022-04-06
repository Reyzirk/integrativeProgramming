<?php
include '../Function/load.php';
include './Function/parent.php';
$pageName = basename(__FILE__);
?>
<!DOCTYPE html>
<!--
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
@author Tang Khai Li
-->

<?php
#Page Languages
$lang_add_btn = "Add New Parent";
$lang_refresh_btn = "Refresh";
$lang_action_btn = "Action";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Parent</title>
        <?php
        include './Components/headmeta.php';
        ?>
        <script src="js/announcement.js" type="text/javascript"></script>
    </head>
    
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Parent</li>
                    </ol>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-20">
                            <div id="displayList">
                                <div class="jumbotrun" id="container">
                                    <div class="rightSide">
                                        <button class="btn btn-info" onclick="location.href = 'addParent.php'"><i class="fa-solid fa-square-plus"></i> <?php echo $lang_add_btn; ?></button> 
                                    </div>
                                    <div class="leftSide">
                                        <button class="btn btn-warning" onclick="displayList()"><?php echo $lang_refresh_btn; ?></button>
                                    </div>
                                    <br/>
                                   
                                    
                                    <div id="displayPagination">
                                    </div>
                                </div>
                            </div>
                            </div>    
                        </div>
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
    </body>
</html>

