<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/CourseScheduleDB.php';
require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Objects/Course.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Courses");
$totalCount = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Course Code" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
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
$scheduledb = new CourseScheduleDB();
if ($sortType==="Course Code"){
    $sortType = "courseschedule.CourseCode";
}else if ($sortType==="Instructor"){
    $sortType = "InstructorName";
}else if ($sortType==="Day of Week"){
    $sortType = "Day";
}else if ($sortType==="Time"){
    $sortType = "TimeStart";
}else if ($sortType==="Class Type"){
    $sortType = "ClassType";
}
try{
    $totalCount = $scheduledb->getCount($search,$id);
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
    $query = $builder->select(array("courseschedule","classes","instructor"), array("ScheduleID","courseschedule.CourseCode",
            "courseschedule.ClassID","InstructorName","TimeStart","Duration","ClassType","Day"))
        ->where("courseschedule.CourseCode", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("TimeStart", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Duration", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ClassType", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Day", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("courseschedule.ClassID", "classes.ClassID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("courseschedule.InstructorID", "instructor.InstructorID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("courseschedule.ClassID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->bracketWhere(WhereTypeEnum::AND)
        ->order($sortType, $sortOrder)
        ->limit($beginIndex,$endIndex)
        ->query();
    try{
        $results = $scheduledb->select($query);
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"]==true){
            echo $ex->getMessage();
        }else{
            callPDOExceptionLog($ex);
        }

    }
   
    foreach($results as $row){
        $timeStart = new DateTime($row["TimeStart"]);
        $endtime = new DateTime($row["TimeStart"]);
        $endtime->add(new DateInterval('PT' . $row["Duration"] . 'M'));
        ?>
        <tr id="<?php echo $row["ClassID"]; ?>">
            <td class="text-center"><?php echo $row["CourseCode"]; ?>
                <br/>
                <?php echo $parser->getCourse($row["CourseCode"])->courseName; ?>
            </td>
            <td class="text-center"><?php echo $row["InstructorName"]; ?></td>
            <td class="text-center"><?php echo $row["Day"]; ?></td>
            <td class="text-center"><?php echo $timeStart->format("h:i A"); ?> - <?php echo $endtime->format('h:i A'); ?><br/><b><?php echo convertMinute($row["Duration"]); ?></b></td>
            <td class="text-center"><?php echo $row["ClassType"]; ?></td>
            <td class="text-center">
                <button class='btn btn-outline-warning' onclick="location.href='editcourseschedule.php?id=<?php echo $row["ScheduleID"]; ?>';"><i class="fa-solid fa-pen-to-square"></i> Modify</button>
                <button class='btn btn-outline-danger' onclick="deleteDataRecord('<?php echo $row["ScheduleID"]; ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
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