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
-->

<!--
Login page
@author Shu Ling
 -->

 <?php
    include 'Function/forgotPassword.php';
 ?>
 
 <html>
     <head>
         <meta charset = "UTF-8">
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

        
            <section id="forgotPassword">
                <div class="wrapper">
                    <h2>Forgot Password</h2>
                    <p style="margin-left: 5%; margin-right: 5%;">Please enter the account of email that you want reset the password and we will send you the information to change your password.</p>
                    <!--The user need to complete all the form section then they can make the register-->
                    <form id="forgetPasswordForm" action="" method="POST">
                        <div id="userDetails">
                            <!--Enter email details-->
                            <label><p><b>Email Address</b></p></label>
                            <input type="parentEmail" id="parentEmail" style="height: 25px; width: 40%;border: 1px solid grey;border-radius: 25px;" name="parentEmail" size="50" maxlength="50" class="form-control" placeholder="abc@gmail.com">
   
                            <div class="text-danger"><?php echo (!empty($parentEmail_err)) ? $parentEmail_err : '';?>
                            </div>
                        </div>  
                            <!--Enter next button after provide email details-->
                        <br/>
                       <div>
                           
                           <input type="submit" value="Submit" name="forgotPassword" id="nextBtn" style="background-color: blue; color: white; border-radius: 25px; width: 100px;">
                           
                       </div>
                       <p>Have an account?<a href="login.php"> Login Now!</a></p>
                    </form>
                </div>
            </section>
        
    </body>
</html>
