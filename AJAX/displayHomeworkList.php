<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
/**
 * Description of displayHomeworkList
 *
 * @author Choo Meng
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/HomeworkDB.php';
$totalCount = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Date" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "DESC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? "" : eliminateExploit($_POST["search"]);
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
$homeworkdb = new HomeworkDB();
if ($sortType==="Homework ID"){
    $sortType = "HomeworkID";
}else if ($sortType==="Date"){
    $sortType = "Date";
}else if ($sortType==="Homework"){
    $sortType = "HomeworkDesc";
}
try{
    $totalCount = $homeworkdb->getCount($search,$id);
} catch (PDOException $ex) {
    if ($generalSection["maintenance"]==true){
        echo $ex->getMessage();
    }else{
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
    $builder = new MySQLQueryBuilder();
    $query = $builder->select(array("homework"), array("*"))
        ->where("HomeworkID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Date", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("HomeworkDesc", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("ClassID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->order($sortType, $sortOrder)
        ->limit($beginIndex,$endIndex)
        ->query();
    try{
        $results = $homeworkdb->select($query);
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"]==true){
            echo $ex->getMessage();
        }else{
            callPDOExceptionLog($ex);
        }

    }
    foreach($results as $row){
        $desc = strip_tags(html_entity_decode($row["HomeworkDesc"]));
        ?>
        <tr id="<?php echo $row["HomeworkID"]; ?>">
            <td class="text-center" style="word-break: break-all;"><?php echo $row["HomeworkID"]; ?></td>
            <td class="text-center"><?php echo $row["Date"]; ?></td>
            <td><?php echo strlen($desc)>150?substr($desc,0,150):$desc; ?></td>
            <td class="text-center">
                <button class='btn btn-outline-info' onclick="location.href='viewhomework.php?id=<?php echo $row["HomeworkID"]; ?>';"><i class="fa-solid fa-eye"></i> View</button>
            </td>
        </tr>
        <?php
    }
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}