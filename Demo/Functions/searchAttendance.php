<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Author: Ng Kar Kai
$btnClicked = false;
if (isset($_POST["searchBtn"])){
    $btnClicked = true;
    $childName = antiExploit($_POST['searchInfo']);
}


function antiExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
?>

