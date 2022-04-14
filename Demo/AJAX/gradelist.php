<?php
//Author: Poh Choo Meng
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", str_replace("Demo", "", dirname(__DIR__)))."/Objects/Grade.php";
$apiKey = "d61a42d239989eb9df075a70b5ad0e1435f7b186";
$search = empty($_POST["search"]) ? "" : eliminateExploit($_POST["search"]);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
$page = file_get_contents("http://localhost/IPAssignment/cmapi.php/grade/list?api-key=$apiKey&limit=$entry&index=$currentPage&search=$search");
$jsonStr = json_decode($page)[0];
if ($jsonStr->Status=="Success"){
    $dataStr = $jsonStr->Data;
    $count = 0;
    $courseList = array();
    $variable = "Grade ID";
    $variable1 = "Grade";
    $variable2 = "Min Mark";
    $variable3 = "Max Mark";
    $variable4 = "Total Record in Database";
    $totalCount = $jsonStr->$variable4;
    $beginIndex = ($currentPage - 1) * $entry;
    $endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
    foreach($dataStr as $grade){
        $row = new Grade($grade->$variable, $grade->$variable1, $grade->$variable2, $grade->$variable3)
        ?>
        <tr id="<?php echo $row->gradeID; ?>">
            <td class="text-center"><?php echo $row->grade; ?>
            </td>
            <td class="text-center"><?php echo $row->minMark; ?></td>
            <td class="text-center"><?php echo $row->maxMark; ?></td>
        </tr>
        <?php
    }
    

    if (empty($dataStr)||$totalCount==0) {
        ?>
        <tr>
            <td colspan='4'height='60px' class='emptySlot'>
                <b>NO RESULT FOUND</b>
            </td>
        </tr>
        <?php
    }
}else{
    ?>
    <tr>
        <td colspan='4'height='60px' class='emptySlot'>
            <b>NO RESULT FOUND</b>
        </td>
    </tr>
    <?php
}
//For PHP version that below 8.0
function custom_str_contains(string $haystack, string $needle): bool {
    return '' === $needle || false !== strpos($haystack, $needle);
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}