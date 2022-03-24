<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/AnnouncementDB.php';

$totalCount = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Date" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "DESC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? "" : eliminateExploit($_POST["search"]);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];

$announceDB = new AnnouncementDB();
if ($sortType === "Announcement ID") {
    $sortType = "AnnounceID";
} else if ($sortType === "Date") {
    $sortType = "Date";
} else if ($sortType === "Title") {
    $sortType = "Title";
} else if ($sortType === "Category") {
    $sortType = "Cat";
}
try {
    $totalCount = $announceDB->getCountBySearch($search); 
} catch (PDOException $ex) {
    if ($generalSection["maintenance"] == true) {
        echo $ex->getMessage();
    } else {
        callPDOExceptionLog($ex);
    }
}
$beginIndex = ($currentPage - 1) * $entry;
$endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);

if ($totalCount == 0) {
    ?>
    <tr>
        <td colspan='7'height='60px' class='emptySlot'>
            <b>NO RESULT FOUND</b>
        </td>
    </tr>
    <?php
} else {
    ?>

    <?php
    $builder = new MySQLQueryBuilder();
    $query = $builder->select(array("announcement"), array("*"))
            ->where("AnnounceID", "%" . $search . "%", WhereTypeEnum::OR, OperatorEnum::LIKE)
            ->where("Date", "%" . $search . "%", WhereTypeEnum::OR, OperatorEnum::LIKE)
            ->where("Title", "%" . $search . "%", WhereTypeEnum::OR, OperatorEnum::LIKE)
            ->where("Cat", "%" . (empty($search)?"":strtoupper($search[0])) . "%", WhereTypeEnum::OR, OperatorEnum::LIKE)
            ->bracketWhere(WhereTypeEnum::OR)
            ->where(1, 1, WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
            ->order($sortType, $sortOrder)
            ->limit($beginIndex, $endIndex)
            ->query();
    try {
        $results = $announceDB->select($query);
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"] == true) {
            echo $ex->getMessage();
        } else {
            callPDOExceptionLog($ex);
        }
    }
    foreach ($results as $row) {
        $title = strip_tags(html_entity_decode($row["Title"]));
        ?>
        <tr id="<?php echo $row["AnnounceID"]; ?>">
            <td class="text-center" style="word-break: break-all;"><?php echo $row["AnnounceID"]; ?></td>
            <td class="text-center"><?php echo $row["Date"]; ?></td>
            <td style="word-break: break-all;"><?php echo strlen($title) > 150 ? substr($title, 0, 150) : $title; ?></td>
            <td class="text-center"><?php echo convertCatToWord($row["Cat"]); ?></td>
            <td class="text-center">
                <button class='btn btn-outline-info' onclick="location.href = 'viewAnnouncement.php?id=<?php echo $row["AnnounceID"]; ?>';"><i class="fa-solid fa-eye"></i> View</button>
                <button class='btn btn-outline-warning' onclick="location.href = 'editAnnouncement.php?aID=<?php echo $row["AnnounceID"]; ?>';"><i class="fa-solid fa-pen-to-square"></i> Modify</button>
                <button class='btn btn-outline-danger' onclick="deleteDataRecord('<?php echo $row["AnnounceID"]; ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
            </td>
        </tr>
        <?php
    }
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

//***********Convert Category Char to String***************
function convertCatToWord($cat){
    switch($cat){
        case 'A':
            return "Activity";break;
        case 'C':
            return "Covid-19";break;
        case 'E':
            return "Examination";break;
        case 'H':
            return "Homework";break;
        case 'N':
            return "Notice";break;
        case 'T':
            return "Tuition";break;
        case 'W':
            return "News";break;
    }
}
