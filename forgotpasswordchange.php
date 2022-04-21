<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'Function/ini_load.php';
?>

<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
author : Fong Shu Ling
-->




 <?php
    include 'Function/forgotPasswordChange.php';
 ?>


<html>
    <head>
        <meta charset="UTF-8">
        <?php
        require_once 'XML/WebPageParser.php';
        $author = "Ng Kar Kai, Oon Kheng Huang, Tang Khai Li, Fong Shu Ling, Poh Choo Meng";
        $keywords = "Kindergarden, Education, Learning";
        $fileName = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);
        $companyName = $generalSection["companyName"];
        $parser = new WebPageParser("XML/ParentSideWebPage.xml");
        $webpage = empty($parser->getWebpage()[str_replace(".php", "", strtolower($fileName))]) ? "" :
                $parser->getWebpage()[str_replace(".php", "", strtolower($fileName))];
        $pageTitle = empty($webpage) ? "" : $webpage->pageTitle;
        $description = empty($webpage) ? "" : $webpage->pageDescription;

        echo("
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='author' content='$author'>
        <meta name='keywords' content='$keywords'>
        <meta name='description' content='$description'>
        <title>$pageTitle | $companyName</title>
        <link href='css/sweetalert2.min.css' rel='stylesheet' type='text/css'/>
        <link href='css/forgotPassword.css' rel='stylesheet' type='text/css'/>
        <script src='https://kit.fontawesome.com/3f628a0091.js' crossorigin='anonymous'></script>
        <script src='js/jquery-3.6.0.js' type='text/javascript'></script>
        <script src='js/sweetalert2.all.min.js' type='text/javascript'></script>
        <script src='js/ckeditor.js' type='text/javascript'></script>
        <script src='js/bootstrap.bundle.min.js' type='text/javascript'></script>
            ");
        ?>
    </head>
    
    <body>
        <div class="wrapper">
            
            <h2>Reset Password</h2><br>

            <form method="post" style="text-align: center;">
                <!--************************New Password***************************-->
                <div class="row">
                    <div class="col-md">
                        <label for="newPass" class="col-form-label">New Password <span class="requiredF"></span></label>
                        <div>
                        <input id="currentPass" type="password" name="newPass" style="height: 25px; width: 40%;border: 1px solid grey;border-radius: 25px;" class="bg-white form-control <?php echo empty($error["newPass"]) ? "" : "is-invalid"; ?>" placeholder="Please enter new password" 
                               maxlength="60""/>
                        <div class="text-danger"> <?php echo (!empty($currentPass_err)) ? $currentPass_err : '';?> </div>
                        <span class="invalid-feedback"><?php echo empty($error["newPass"]) ? "" : $error["newPass"]; ?></span>
                        </div>
                    </div>
                </div><br/>
                <!--************************Confirm Password***************************-->
                <div class="row">
                    <div class="col-md">
                        <label for="confirmPass" class="col-form-label">Confirm Password <span class="requiredF"></span></label>
                        <div>
                        <input id="confirmPass" type="password" name="confirmPass" style="height: 25px; width: 40%;border: 1px solid grey;border-radius: 25px;"class="bg-white form-control <?php echo empty($error["confirmPass"]) ? "" : "is-invalid"; ?>" placeholder="Please re-enter new password" 
                               maxlength="60" "/>
                        <div class="text-danger">
                            <?php 
                                echo (!empty($confirmPass_err)) ? $confirmPass_err : '';
                            ?>
                            </div>
                        <span class="invalid-feedback"><?php echo empty($error["confirmPass"]) ? "" : $error["confirmPass"]; ?></span>
                        </div>
                    </div>
                </div><br/>

                <div class="reset">
                    <input type="submit" class="btn btn-primary" value="Reset" style="background-color: blue; color: white; border-radius: 25px; width: 100px; height: 40px;">
                </div>
                <p>Please remember your password after reset!</p>

            </form>
        </div>   
    </body>
</html>
