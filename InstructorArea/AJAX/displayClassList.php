<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
/**
 * Description of displayClassList
 *
 * @author Choo Meng
 */

require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/ClassDB.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/HomeworkDB.php';
$totalCount = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Class ID" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? "" : eliminateExploit($_POST["search"]);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];

$classdb = new ClassDB();
if ($sortType==="Class ID"){
    $sortType = "classes.ClassID";
}else if ($sortType==="Students"){
    $sortType = "totalstudent";
}else if ($sortType==="Instructor"){
    $sortType = "InstructorName";
}else if ($sortType==="Homeworks"){
    $sortType = "totalhomework";
}else if ($sortType==="Class Duration"){
    $sortType = "ClassStart";
}
try{
    $totalCount = $classdb->getCount($search);
} catch (PDOException $ex) {
    echo 'Connection failed: ' . $ex->getMessage();
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
    $query = $builder->select(array("classes"), array("classes.ClassStart","classes.ClassEnd","classes.ClassID","Semester","Year","InstructorName","COUNT(childclass.ChildID) as totalstudent"))
        ->join("instructor","classes.InstructorID","instructor.InstructorID")
        ->join("childclass","classes.ClassID","childclass.ClassID", JoinTypeEnum::LEFT)
        ->where("classes.ClassID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Semester", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ClassStart", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Year", "%$search%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->groupby(array("classes.ClassID"))
        ->order($sortType, $sortOrder)
        ->limit($beginIndex,$endIndex)
        ->query();
    
    $results = $classdb->select($query);
    
   
    foreach($results as $row){
        $homeworkdb = new HomeworkDB();
        $totalHomework = $homeworkdb->getCount("", $row["ClassID"]);
        $startDate = date_create((string)$row["ClassStart"]);
        $endDate = date_create((string)$row["ClassEnd"]);
        ?>
        <tr id="<?php echo $row["ClassID"]; ?>">
            <td class="text-center"><?php echo $row["ClassID"]; ?></td>
            <td class="text-center"><?php echo $row["Semester"]; ?></td>
            <td class="text-center"><?php echo $row["Year"]; ?></td>
            <td class="text-center"><?php echo $row["InstructorName"]; ?></td>
            <td class="text-center"><?php echo $row["ClassStart"]." - ".$row["ClassEnd"]; ?><br/>(<?php echo convertDayToWeek(date_diff($startDate,$endDate)->format("%a")) ?>)</td>
            <td class="text-center">
                <button class="btn btn-outline-info" style="width:60px;" onclick="location.href='childclasses.php?id=<?php echo $row["ClassID"]; ?>';">👨‍🎓 <?php echo $row["totalstudent"]; ?></button>
                
            </td>
            <td class="text-center">
                <button class="btn btn-outline-dark" style="width:60px;" onclick="location.href='homeworks.php?id=<?php echo $row["ClassID"]; ?>';">📚 <?php echo $totalHomework; ?></button>
            </td>
            <td class="text-center">
                <button class='btn btn-outline-warning' onclick="location.href='editclass.php?id=<?php echo $row["ClassID"]; ?>';"><i class="fa-solid fa-pen-to-square"></i> Modify</button>
                <button class='btn btn-outline-danger' onclick="deleteDataRecord('<?php echo $row["ClassID"]; ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
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