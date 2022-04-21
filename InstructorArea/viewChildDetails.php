<?php
include '../Function/load.php';
include "Function/viewChild.php";
$pageName = basename(__FILE__);
//include './Function/viewChild.php';
?>

<!DOCTYPE html>

<!--/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * InstructorArea/viewParent
 * 
 * author Tang Khai Li
 */-->

<?php
#Page Languages
$lang_title = "View Child";
$lang_description = "View existing child.";
$lang_legendTitle = "Child Details";
$lang_required = "Existing child details";
$lang_refresh_btn = "Refresh";
?>

<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="announcement.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="parent.php">Parent</a></li>
                        <li class="breadcrumb-item active">View Child Details</li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-20">
                                <div id="displayList">
                                    <div class="jumbotrun" id="container">
                                        <div class="leftSide">
                                            <button class="btn btn-warning" onclick="location.href = 'viewChildDetails.php?<?php echo $id?>'"><?php echo $lang_refresh_btn; ?></button>
                                        </div>

                                        <div id="displayPagination">
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <br/>
                        <br/>
                        <div class="row">
                            <div class="col-md">
                                <table class="table table-hover" id="tableList">
                                    <thead>
                                    <th>Child ID</th>
                                    <th>Parent Name</th>
                                    <th>Child Name</th>
                                    <th>Child Birth Date</th>
                                    <th>Child IC No</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody id="tableContent">
                                        <?php
                                        displayList();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "Components/footer.php"; ?>
    </body>
</html>

