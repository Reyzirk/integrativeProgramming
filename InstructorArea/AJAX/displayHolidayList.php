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
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/HolidaysParser.php';
$parser = new HolidaysParser(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/holidays.xml");
$holidays = $parser->getHolidays();
$count = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Date" : $_POST["sorttype"]);
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : $_POST["sortorder"]);
$search = empty($_POST["search"]) ? null : $_POST["search"];
$totalCount = count($holidays);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
$totalPage = (int) (ceil($totalCount / $entry));
$beginIndex = ($currentPage - 1) * $entry;
$endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
//Convert to indexed array
foreach ($holidays as $key) {
    $holidayList[] = $key;
}
//Sorting
if (empty($holidayList)) {
    if ($sortType == "Holiday") {
        empty($holidayList)?"":usort($holidayList, $sortOrder == "ASC" ? "compareNameAsc" : "compareNameDesc");
    } else if ($sortType == "Date") {
        empty($holidayList)?"":usort($holidayList, $sortOrder == "ASC" ? "compareDateAsc" : "compareDateDesc");
    }
}

if (count($holidays) == 0) {
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
        $valueDateStart = (string) $key->getdateStart();
        $valueDateEnd = (string) $key->getdateEnd();
        $dateStart = new DateTime($valueDateStart);
        $dateEnd = new DateTime($valueDateEnd);
        if (empty($search) ||
                (
                str_contains($key->getName(), empty($search) ? "" : $search) ||
                str_contains($valueDateStart, empty($search) ? "" : $search) ||
                str_contains($valueDateEnd, empty($search) ? "" : $search)
                )
        ) {
            $count++;
            ?>
            <tr id="<?php echo $key->getId(); ?>">
                <td><?php echo $key->getName(); ?></td>
                <td class='text-center'><?php
            echo $valueDateStart;
            if ($dateStart->diff($dateEnd)->d >= 1) {
                ?>
                        <b>until</b> <?php echo $valueDateEnd; ?>
                        <?php
                    }
                    ?>
                </td>
                <td class="text-center">
                    <button class='btn btn-info' onclick="location.href='editholiday.php?id=<?php echo $key->getId(); ?>';"><i class="fa-solid fa-pen-to-square"></i> Modify</button>
                    <button class='btn btn-danger' onclick="deleteDataRecord('<?php echo $key->getId(); ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
                </td>
            </tr>
            <?php
        }
    }
    if ($count == 0) {
        ?>
        <tr>
            <td colspan='3'height='60px' class='emptySlot'>
                <b>NO RESULT FOUND</b>
            </td>
        </tr>
        <?php
    }
}

function str_contains(string $haystack, string $needle): bool {
    return '' === $needle || false !== strpos($haystack, $needle);
}

//Compare value

function compareNameAsc($valueA, $valueB) {
    return strcmp($valueA->getName(), $valueB->getName());
}

function compareNameDesc($valueB, $valueA) {
    return strcmp($valueA->getName(), $valueB->getName());
}

function compareDateAsc($valueA, $valueB) {
    return strcmp((string) $valueA->getdateStart(), (string) $valueB->getdateStart());
}

function compareDateDesc($valueB, $valueA) {
    return strcmp((string) $valueA->getdateStart(), (string) $valueB->getdateStart());
}
