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
    $query = $builder->select(array("classes"), array("classes.ClassID","Semester","Year","InstructorName","COUNT(childclass.ChildID) as totalstudent","COUNT(homework.HomeworkID) as totalhomework"))
        ->join("instructor","classes.InstructorID","instructor.InstructorID")
        ->join("childclass","classes.ClassID","childclass.ClassID", JoinTypeEnum::LEFT)
        ->join("homework","classes.ClassID","homework.ClassID", JoinTypeEnum::LEFT)
        ->where("classes.ClassID", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Semester", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("Year", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::EQUAL)
        ->where("InstructorName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->groupby(array("classes.ClassID"))
        ->order($sortType, $sortOrder)
        ->limit($beginIndex,$endIndex)
        ->query();
    
    $results = $classdb->select($query);
    
   
    foreach($results as $row){
        ?>
        <tr id="<?php echo $row["ClassID"]; ?>">
            <td class="text-center"><?php echo $row["ClassID"]; ?></td>
            <td class="text-center"><?php echo $row["Semester"]; ?></td>
            <td class="text-center"><?php echo $row["Year"]; ?></td>
            <td class="text-center"><?php echo $row["InstructorName"]; ?></td>
            <td class="text-center">
                <button class="btn btn-info" style="width:60px;"><i class="fa-solid fa-person"></i> <?php echo $row["totalstudent"]; ?></button>
                
            </td>
            <td class="text-center">
                <button class="btn btn-dark" style="width:60px;" onclick="location.href='homeworks.php?id=<?php echo $row["ClassID"]; ?>';"><i class="fa-solid fa-book-open"></i> <?php echo $row["totalhomework"]; ?></button>
            </td>
            <td class="text-center">
                <button class='btn btn-warning' onclick="location.href='editclass.php?id=<?php echo $row["ClassID"]; ?>';"><i class="fa-solid fa-pen-to-square"></i> Modify</button>
                <button class='btn btn-danger' onclick="deleteDataRecord('<?php echo $row["ClassID"]; ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
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