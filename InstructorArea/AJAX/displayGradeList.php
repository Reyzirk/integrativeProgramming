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
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Grades");
$grades = $parser->getGrades();
$count = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Grade" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? null : eliminateExploit($_POST["search"]);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
//Convert to indexed array
foreach ($grades as $key) {
    $minMark = $key->minMark;
    $maxMark = $key->maxMark;
    $mark = empty($search)?0:(is_double($search)? doubleval($search):0);
    if (empty($search) ||
            (
            custom_str_contains($key->grade, empty($search) ? "" : $search) ||
            ($mark>=$minMark && $mark <= maxMark)
            )
    ) {
        $count++;
        $gradeList[] = $key;
    }
    
}
$totalCount = $count;
$beginIndex = ($currentPage - 1) * $entry;
$endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
//Sorting
if (!empty($gradeList)) {
    if ($sortType == "Grade") {
        empty($gradeList)?"":usort($gradeList, $sortOrder == "ASC" ? "compareGradeAsc" : "compareGradeDesc");
    }else if ($sortType == "Min Mark") {
        empty($gradeList)?"":usort($gradeList, $sortOrder == "ASC" ? "compareMinMarkAsc" : "compareMinMarkDesc");
    } else if ($sortType == "Max Mark") {
        empty($gradeList)?"":usort($gradeList, $sortOrder == "ASC" ? "compareMaxMarkAsc" : "compareMaxMarkDesc");
    }else{
        empty($gradeList)?"":usort($gradeList, "compareMinMarkDesc");
    }
}

if (count($grades) == 0 || $count == 0) {
    ?>
    <tr>
        <td colspan='4'height='60px' class='emptySlot'>
            <b>NO RESULT FOUND</b>
        </td>
    </tr>
    <?php
} else {
    for ($i = $beginIndex; $i < $endIndex; $i++) {
        $key = $gradeList[$i];
        ?>
        <tr id="<?php echo $key->gradeID; ?>">
            <td class="text-center"><?php echo $key->grade; ?></td>
            <td class="text-center"><?php echo $key->minMark; ?></td>
            <td class="text-center"><?php echo $key->maxMark; ?></td>
            <td class="text-center">
                <button class='btn btn-outline-warning' onclick="location.href='editgrade.php?id=<?php echo $key->gradeID; ?>';"><i class="fa-solid fa-pen-to-square"></i> Modify</button>
                <button class='btn btn-outline-danger' onclick="deleteDataRecord('<?php echo $key->gradeID; ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
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
function compareGradeAsc($valueA, $valueB) {
    return strcmp($valueA->grade, $valueB->grade);
}

function compareGradeDesc($valueB, $valueA) {
    return strcmp($valueA->grade, $valueB->grade);
}

function compareMinMarkAsc($valueA, $valueB) {
    return $valueA->minMark-$valueB->minMark;
}

function compareMinMarkDesc($valueB, $valueA) {
    return $valueA->minMark-$valueB->minMark;
}

function compareMaxMarkAsc($valueA, $valueB) {
    return $valueA->maxMark-$valueB->maxMark;
}

function compareMaxMarkDesc($valueB, $valueA) {
    return $valueA->maxMark-$valueB->maxMark;
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
