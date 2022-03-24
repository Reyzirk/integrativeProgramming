<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * Author: Ng Kar Kai
 */
require_once ( str_replace("AJAX", "", dirname(__DIR__))) . '/Function/AttendanceFacade.php';
//print_r($_POST);
$submitBtn = false;
if (isset($_POST['submitBtn'])) {
    $criteria = antiExploit($_POST['searchCriteria']);
    $searchInfo = antiExploit($_POST['searchInfo']);

    if (empty($searchInfo)) {
        $error["emptySearch"] = "Please do not leave the search bar empty";
    }
    if (empty($error)) {
        $submitBtn = true;
    }
}


function antiExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

?>
