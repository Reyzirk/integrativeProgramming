<?php
include '../Function/load.php';$pageName = basename(__FILE__); 
?>

<!DOCTYPE html>
<!-- 
 ============================================
 Copyright 2022 Omega International Junior School. All Right Reserved.
 Web Application is under GNU General Public License v3.0
 ============================================
 @author Tang Khai Li
-->

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
                        <li class="breadcrumb-item active">Add Parent</li>
                    </ol>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-20">
                            <div id="displayList">
                                <div class="jumbotrun" id="container">
                                    
                                    <!--***Parent Details Form***-->
                                    
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





