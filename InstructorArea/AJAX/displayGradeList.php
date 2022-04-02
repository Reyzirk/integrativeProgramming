<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of displayGradeList
 *
 * @author Choo Meng
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/XSLTFactory.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Grades");
$grades = $parser->getGrades();
$count = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Grade" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? null : eliminateExploit($_POST["search"]);
if ($sortType=="Grade"){
    $sortType = "grade";
}else if ($sortType=="Min Mark"){
    $sortType = "minMark";
}else if ($sortType=="Max Mark"){
    $sortType = "maxMark";
}
if ($sortOrder=="ASC"){
    $sortOrder = "ascending";
}else{
    $sortOrder = "descending";
}
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
//Convert to indexed array
while($key = $grades->next()){
    $minMark = $key->minMark;
    $maxMark = $key->maxMark;
    $mark = empty($search)?0:(is_double($search)? doubleval($search):0);
    if (empty($search) ||
            (
            custom_str_contains($key->grade, empty($search) ? "" : $search) ||
            ($mark>=$minMark && $mark <= $maxMark)
            )
    ) {
        $count++;
    }
    
}
$totalCount = $count;
$beginIndex = ($currentPage - 1) * $entry;
$endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
$xsltFactory = new XSLTFactory();
$xslt = $xsltFactory->getXSLT("Grades");
$xslt->setStyleSheet(str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/gradelist.xsl');

$result = $xslt->displayList($search, $sortType, $sortOrder, $beginIndex-1, $endIndex+1);
if (empty($result)||$totalCount==0) {
    ?>
    <tr>
        <td colspan='4'height='60px' class='emptySlot'>
            <b>NO RESULT FOUND</b>
        </td>
    </tr>
    <?php
} else {
    echo $result;
}
//For PHP version that below 8.0
function custom_str_contains(string $haystack, string $needle): bool {
    return '' === $needle || false !== strpos($haystack, $needle);
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
