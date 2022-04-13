<?php
//Author: Poh Choo Meng
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
if (empty($_SESSION["childID"])){
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: selectchild.php?transferpath=timetable');
}
function callLog() {
    if (!empty($_SESSION["errorLog"])) {

        if ($_SESSION["errorLog"] == "noid") {
            $errorMsg = "Invalid Class ID";
        }
        if ($_SESSION["errorLog"] == "noaccess") {
            $errorMsg = "No access to this class timetable";
        }
        ?>
        <script>
            setTimeout(function (){
                Toast.fire({
                    icon: 'error',
                    html: '<b>Failed</b><br/><?php echo $errorMsg; ?>.'
                })
            },1500);
        </script>
        <?php
        unset($_SESSION["errorLog"]);
    }
}
function convertDayToWeek($val){
    $val = intval($val)+1;
    $timeStr = "";
    if ($val>=7){
        $weeks = (int)($val/7);
        $timeStr .= $weeks.($weeks>1?" weeks":" week")." ";
        $val = $val%7;
    }
    if ($val >= 1){
        $timeStr = $timeStr.$val.($val>1?" days":" day")." ";
    }
    $timeStr = trim($timeStr);
    return $timeStr;
}