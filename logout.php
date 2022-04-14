<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
//Author: Oon Kheng Huang, Poh Choo Meng, Ng Kar Kai, Fong Shu Ling
-->
<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once 'Function/ini_load.php'; ?>
<html>
    <head>
        <script>
            var i = 2;
            var timer = setInterval(function() {
                document.getElementById("time").innerHTML=i;
                i--;
            },1000);
        </script>
        <meta http-equiv="refresh" content="3; url=login.php" />
    </head>
    <body>
        <?php 
            unset($_SESSION['parentID']);
            unset($_SESSION['childID']);
        ?>
        <h1>Logout Successful!</h1>
        <p class="login">Redirect to home page after <span id="time">3</span> seconds..</p>
    </body>
</html>
