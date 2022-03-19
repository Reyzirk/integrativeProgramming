<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of displayCourseList
 *
 * @author Choo Meng
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Courses");
$courses = $parser->getCourses();
$count = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Date" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? null : eliminateExploit($_POST["search"]);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
//Convert to indexed array
foreach ($courses as $key) {
    if (empty($search) ||
            (
            custom_str_contains($key->courseCode, empty($search) ? "" : $search) ||
            custom_str_contains($key->courseName, empty($search) ? "" : $search)
            )
    ) {
        $count++;
        $courseList[] = $key;
    }
    
}
$totalCount = $count;
$beginIndex = ($currentPage - 1) * $entry;
$endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
//Sorting
if (!empty($courseList)) {
    if ($sortType == "Course Code") {
        empty($courseList)?"":usort($courseList, $sortOrder == "ASC" ? "compareCodeAsc" : "compareCodeDesc");
    }else if ($sortType == "Name") {
        empty($courseList)?"":usort($courseList, $sortOrder == "ASC" ? "compareNameAsc" : "compareNameDesc");
    } else if ($sortType == "Description") {
        empty($courseList)?"":usort($courseList, $sortOrder == "ASC" ? "compareDescAsc" : "compareDescDesc");
    }
}

if (count($courses) == 0 || $count == 0) {
    ?>
    <tr>
        <td colspan='3'height='60px' class='emptySlot'>
            <b>NO RESULT FOUND</b>
        </td>
    </tr>
    <?php
} else {
    for ($i = $beginIndex; $i < $endIndex; $i++) {
        $key = $courseList[$i];
        ?>
        <tr id="<?php echo $key->courseCode; ?>">
            <td class="text-center"><?php echo $key->courseCode; ?></td>
            <td><?php echo $key->courseName; ?></td>
            <td class="text-center">
                <button class='btn btn-outline-info' onclick="location.href='viewcourse.php?id=<?php echo $key->courseCode; ?>';"><i class="fa-solid fa-eye"></i> View</button>
                <button class='btn btn-outline-warning' onclick="location.href='editcourse.php?id=<?php echo $key->courseCode; ?>';"><i class="fa-solid fa-pen-to-square"></i> Modify</button>
                <button class='btn btn-outline-danger' onclick="deleteDataRecord('<?php echo $key->courseCode; ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
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
function compareCodeAsc($valueA, $valueB) {
    return strcmp($valueA->courseCode, $valueB->courseCode);
}

function compareCodeDesc($valueB, $valueA) {
    return strcmp($valueA->courseCode, $valueB->courseCode);
}

function compareNameAsc($valueA, $valueB) {
    return strcmp($valueA->courseName, $valueB->courseName);
}

function compareNameDesc($valueB, $valueA) {
    return strcmp($valueA->courseName, $valueB->courseName);
}

function compareDescAsc($valueA, $valueB) {
    return strcmp((string) $valueA->courseDesc, (string) $valueB->courseDesc);
}

function compareDescDesc($valueB, $valueA) {
    return strcmp((string) $valueA->courseDesc, (string) $valueB->courseDesc);
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

