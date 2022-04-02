<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of displayHolidayList
 *
 * @author Choo Meng
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/XSLTFactory.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Holidays");
$holidays = $parser->getHolidays();
$sortType = trim(empty($_POST["sorttype"]) ? "Date" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? null : eliminateExploit($_POST["search"]);
$count = 0;
if ($sortType=="Date"){
    $sortType = "dateStart";
}else if ($sortType=="Holiday"){
    $sortType = "name";
}
if ($sortOrder=="ASC"){
    $sortOrder = "ascending";
}else{
    $sortOrder = "descending";
}
//Convert to indexed array
while($key = $holidays->next()){
    $valueDateStart = (string) $key->dateStart;
    $valueDateEnd = (string) $key->dateEnd;
    if (empty($search) ||
            (
            custom_str_contains($key->name, empty($search) ? "" : $search) ||
            custom_str_contains($valueDateStart, empty($search) ? "" : $search) ||
            custom_str_contains($valueDateEnd, empty($search) ? "" : $search)
            )
    ) {
        $count++;
    }   
}
$totalCount = $count;
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
$beginIndex = ($currentPage - 1) * $entry;
$endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
$xsltFactory = new XSLTFactory();
$xslt = $xsltFactory->getXSLT("Holidays");
$xslt->setStyleSheet(str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/holidaylist.xsl');

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

