<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of searchAttendance
 *
 * @author Ng Kar Kai
 */
if (isset($_POST['submitBtn'])) {
    $criteria = antiExploit($_POST['searchCriteria']);
    $searchInfo = antiExploit($_POST['searchInfo']);

    if (empty($searchInfo)) {
        $error["emptySearch"] = "Please do not leave the search bar empty";
    }
    if (empty($error)) {
        
    }
}

function antiExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
?>
