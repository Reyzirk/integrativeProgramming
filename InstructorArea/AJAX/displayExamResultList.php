<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/ExamResultDB.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Grade.php";
$factory = new ParserFactory();
$parser = $factory->getParser("Grades");
$totalCount = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "ChildName" : eliminateExploit($_POST["sorttype"]));
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
$resultdb = new ExamResultDB();
if ($sortType==="Student ID"){
    $sortType = "child.ChildID";
}else if ($sortType==="Student Name"){
    $sortType = "child.ChildName";
}
try{
    $totalCount = $resultdb->getCount($search,$id);
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
    $query = $builder->select(array("examresults","child","examination","parent"), array("ChildName","ParentEmail","examresults.Marks","child.ChildID","examresults.ExaminationID"))
        ->where("ParentEmail", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ChildName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("examresults.Marks", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("child.ChildID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("examresults.ExaminationID", "examination.ExaminationID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
        ->where("examresults.ChildID", "child.ChildID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("child.ParentID", "parent.ParentID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("examresults.ExaminationID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->bracketWhere(WhereTypeEnum::AND)
        ->order($sortType, $sortOrder)
        ->limit($beginIndex,$endIndex)
        ->query();
    $results = $resultdb->select($query);
    $index = 0;
   
    foreach($results as $row){
        $index ++;
        $grade = $parser->getGradeByMark($row["Marks"]);
        if (empty($grade)){
            $gradeResult = "NA";
        }else{
            $gradeResult = $grade->grade;
        }
        ?>
        <tr id="<?php echo $row["ChildID"]; ?>">
            <td class="text-center"><?php echo $index; ?></td>
            <td class="text-center"><?php echo $row["ChildID"]; ?></td>
            
            <td class="text-center"><?php echo $row["ChildName"]; ?>
                <br/>
                <?php echo $row["ParentEmail"]; ?> <i class="fa-solid fa-envelope" onclick="location.href='mailto: <?php echo $row["ParentEmail"]; ?>'"></i>
            </td>
            <td class="text-center"><?php echo $row["Marks"]; ?> <b>[<?php echo $gradeResult; ?>]</b></td>
            <td class="text-center">
                <button class='btn btn-outline-warning' onclick="editDataRecord('<?php echo $row["ChildID"]; ?>');"><i class="fa-solid fa-pen-to-square"></i> Modify</button>
                <button class='btn btn-outline-danger' onclick="deleteDataRecord('<?php echo $row["ExaminationID"]; ?>','<?php echo $row["ChildID"]; ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
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