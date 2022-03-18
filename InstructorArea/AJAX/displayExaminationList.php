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

require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/ExaminationDB.php';
$totalCount = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Examination ID" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? "" : eliminateExploit($_POST["search"]);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];

$examdb = new ExaminationDB();
if ($sortType==="Examination ID"){
    $sortType = "examination.ExaminationID";
}else if ($sortType==="Course Code"){
    $sortType = "examination.CourseCode";
}else if ($sortType==="Examiner"){
    $sortType = "InstructorName";
}else if ($sortType==="Exam Start Time"){
    $sortType = "ExamStartTime";
}
else if ($sortType==="Exam Duration"){
    $sortType = "ExamDuration";
}else if ($sortType==="Examinee"){
    $sortType = "totalexaminee";
}
try{
    $totalCount = $examdb->getCount($search);
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
    $query = $builder->select(array("examination"), array("examination.ExaminationID","CourseCode","InstructorName","ExamDuration","ExamStartTime","COUNT(examresults.ChildID) as totalexaminee"))
        ->join("instructor","examination.InstructorID","instructor.InstructorID")
        ->join("examresults","examination.ExaminationID","examresults.ExaminationID", JoinTypeEnum::LEFT)
        ->where("examination.ExaminationID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("CourseCode", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ExamDuration", $search, WhereTypeEnum::OR, OperatorEnum::EQUAL)
        ->where("ExamStartTime", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->groupby(array("examination.ExaminationID"))
        ->order($sortType, $sortOrder)
        ->limit($beginIndex,$endIndex)
        ->query();
    
    $results = $examdb->select($query);
    
   
    foreach($results as $row){
        ?>
        <tr id="<?php echo $row["ExaminationID"]; ?>">
            <td class="text-center"><?php echo $row["ExaminationID"]; ?></td>
            <td class="text-center"><?php echo $row["CourseCode"]; ?></td>
            <td class="text-center"><?php echo $row["InstructorName"]; ?></td>
            <td class="text-center"><?php echo $row["ExamStartTime"]; ?></td>
            <td class="text-center"><?php echo convertMinute($row["ExamDuration"]); ?></td>
            <td class="text-center">
                <button class="btn btn-outline-info" style="width:60px;" onclick="location.href='examresults.php?id=<?php echo $row["ExaminationID"]; ?>';">👨‍🎓 <?php echo $row["totalexaminee"]; ?></button>

            </td>
            <td class="text-center">
                <button class='btn btn-outline-info' onclick="location.href='viewexamination.php?id=<?php echo $row["ExaminationID"]; ?>';"><i class="fa-solid fa-eye"></i> View</button>
                <button class='btn btn-outline-warning' onclick="location.href='editexamination.php?id=<?php echo $row["ExaminationID"]; ?>';"><i class="fa-solid fa-pen-to-square"></i> Modify</button>
                <button class='btn btn-outline-danger' onclick="deleteDataRecord('<?php echo $row["ExaminationID"]; ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
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
function convertMinute($val){
    $timeStr = "";
    if ($val>=1440){
        $days = (int)($val/1440);
        $timeStr .= $days.($days>1?" days":" day")." ";
        $val = $val%1440;
    }
    if ($val>=60){
        $hours = (int)($val/60);
        $timeStr = $timeStr.$hours.($hours>1?" hours":" hour")." ";
        $val = $val%60;
    }
    if ($val >= 1){
        $timeStr = $timeStr.$val.($val>1?" minutes":" minute")." ";
    }
    $timeStr = trim($timeStr);
    return $timeStr;
}