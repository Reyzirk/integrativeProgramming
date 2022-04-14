<?php
include '../Function/load.php';
$pageName = basename(__FILE__);
include './Function/child.php';
?>

<!DOCTYPE html>
<!--/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Tang Khai Li
 */-->

<?php
#Page Languages
$lang_add_btn = "Add New Child";
$lang_refresh_btn = "Refresh";
$lang_action_btn = "Action";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Child</title>
        <?php
        include './Components/headmeta.php';
        ?>
        <script src="js/child.js" type="text/javascript"></script>
    </head>
    
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="announcement.php">Home</a></li>
                        <li class="breadcrumb-item active">Child</li>
                    </ol>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-20">
                            <div id="displayList">
                                <div class="jumbotrun" id="container">
                                    <div class="rightSide">
                                        <button class="btn btn-info" onclick="location.href = 'addChild.php'"><i class="fa-solid fa-square-plus"></i> <?php echo $lang_add_btn; ?></button> 
                                    </div>
                                    <div class="leftSide">
                                        <button class="btn btn-warning" onclick="displayList()"><?php echo $lang_refresh_btn; ?></button>
                                    </div>
                                    <br/>
                                    <table class="table table-hover" id="tableList">
                                        <thead>
                                            <tr class="table-active">
                                                <?php
                                                foreach ($dataArray as $key => $value) {
                                                    ?>
                                                    <th width="<?php echo $value["Width"]; ?>" class="text-center" onclick="sortCol(this)"><?php echo $value["Title"] ?> <i class="fas fa-sort"></i></th>
                                                    <?php
                                                }
                                                ?>
                                                <th width="12%" class="text-center" style="cursor:default;">
                                                    <?php echo $lang_action_btn; ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableContent">
                                        </tbody>
                                    </table>
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

