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
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/ExaminationDB.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Grade.php";
$factory = new ParserFactory();
$parser = $factory->getParser("Grades");
$totalCount = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Examination ID" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? "" : eliminateExploit($_POST["search"]);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
if (!isset($_POST["id"])||!isset($_POST["cid"])){
    
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
    $cid = $_POST["cid"];
}
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
    $totalCount = $examdb->getCountWithID($search,$id);
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
    $query = $builder->select(array("examination"), array("examination.ExaminationID","CourseCode","InstructorName","ExamDuration","ExamStartTime","Marks"))
        ->join("instructor","examination.InstructorID","instructor.InstructorID")
        ->join("examresults","examination.ExaminationID","examresults.ExaminationID")
        ->join("childclass","examresults.ChildID","childclass.ChildID")
        ->where("examination.ExaminationID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("CourseCode", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ExamDuration", $search, WhereTypeEnum::OR, OperatorEnum::EQUAL)
        ->where("ExamStartTime", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Marks", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("childclass.ClassID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->where("examresults.ChildID",$cid)
        ->order($sortType, $sortOrder)
        ->limit($beginIndex,$endIndex)
        ->query();
    try{
        $results = $examdb->select($query);
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"]==true){
            echo $ex->getMessage();
        }else{
            callPDOExceptionLog($ex);
        }

    }
   
    foreach($results as $row){
        $grade = $parser->getGradeByMark($row["Marks"]);
        if (empty($grade)){
            $gradeResult = "NA";
        }else{
            $gradeResult = $grade->grade;
        }
        ?>
        <tr id="<?php echo $row["ExaminationID"]; ?>">
            <td class="text-center"><?php echo $row["CourseCode"]; ?></td>
            <td class="text-center"><?php echo $row["InstructorName"]; ?></td>
            <td class="text-center"><?php echo $row["ExamStartTime"]; ?></td>
            <td class="text-center"><?php echo convertMinute($row["ExamDuration"]); ?></td>
            <td class="text-center"><?php echo ($row["Marks"]==-1?"NA":$row["Marks"]); ?><br/><b>[<?php echo $gradeResult; ?>]</b>
            </td>
            <td class="text-center">
                <button class='btn btn-outline-info' onclick="location.href='viewexamination.php?id=<?php echo $row["ExaminationID"]; ?>';"><i class="fa-solid fa-eye"></i> View</button>
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