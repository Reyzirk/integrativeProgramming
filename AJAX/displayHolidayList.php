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
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/ClassDB.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Holidays");
$holidays = $parser->getHolidays();
$count = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Date" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? null : eliminateExploit($_POST["search"]);

$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
if (!isset($_POST["id"])){
    
?>
    <tr>
        <td colspan='7'height='60px' class='emptySlot'>
            <b>NO RESULT FOUND</b>
        </td>
    </tr>
<?php
    return;
}else{
    $id = $_POST["id"];
}
$classdb = new ClassDB();
$result = $classdb->details($id);
$classStart = new DateTime($result->classStart);
$classEnd = new DateTime($result->classEnd);
//Convert to indexed array
while($key = $holidays->next()){
    $valueDateStart = (string) $key->dateStart;
    $valueDateEnd = (string) $key->dateEnd;
    $dateStart = new DateTime($valueDateStart);
    $dateEnd = new DateTime($valueDateEnd);
    if (($classStart>=$dateStart&&$classEnd>=$dateStart&&$classStart<=$dateEnd)){
        if (empty($search) ||
            (
            custom_str_contains($key->name, empty($search) ? "" : $search) ||
            custom_str_contains($valueDateStart, empty($search) ? "" : $search) ||
            custom_str_contains($valueDateEnd, empty($search) ? "" : $search)
            )
        ) {
            $count++;
            $holidayList[] = $key;
        }   
    }
    
}
$totalCount = $count;
$beginIndex = ($currentPage - 1) * $entry;
$endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
//Sorting
if (!empty($holidayList)) {
    if ($sortType == "Holiday") {
        empty($holidayList)?"":usort($holidayList, $sortOrder == "ASC" ? "compareNameAsc" : "compareNameDesc");
    } else if ($sortType == "Date") {
        empty($holidayList)?"":usort($holidayList, $sortOrder == "ASC" ? "compareDateAsc" : "compareDateDesc");
    }
}

if (count($holidays) == 0||$count==0) {
    ?>
    <tr>
        <td colspan='3'height='60px' class='emptySlot'>
            <b>NO RESULT FOUND</b>
        </td>
    </tr>
    <?php
} else {
    for ($i = $beginIndex; $i < $endIndex; $i++) {
        $key = $holidayList[$i];
        $valueDateStart = (string) $key->dateStart;
        $valueDateEnd = (string) $key->dateEnd;
        $dateStart = new DateTime($valueDateStart);
        $dateEnd = new DateTime($valueDateEnd);
        ?>
        <tr id="<?php echo $key->id; ?>">
            <td><?php echo $key->name; ?></td>
            <td class='text-center'><?php
        echo $valueDateStart;
        if ($dateStart->diff($dateEnd)->d >= 1) {
            ?>
                    <b>until</b> <?php echo $valueDateEnd; ?>
                    <?php
                }
                ?>
            </td>
        </tr>
        <?php
    }
}
//For PHP version that below 8.0
function custom_str_contains(string $haystack, string $needle): bool {
    return '' === $needle || false !== strpos($haystack, $needle);
}

//Compare value

function compareNameAsc($valueA, $valueB) {
    return strcmp($valueA->name, $valueB->name);
}

function compareNameDesc($valueB, $valueA) {
    return strcmp($valueA->name, $valueB->name);
}

function compareDateAsc($valueA, $valueB) {
    return strcmp((string) $valueA->dateStart, (string) $valueB->dateStart);
}

function compareDateDesc($valueB, $valueA) {
    return strcmp((string) $valueA->dateStart, (string) $valueB->dateStart);
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

